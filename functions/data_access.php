<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 4/25/2016
 * Time: 9:55 AM
 */

$config = null;

function get_config_data() {
  
  global $config;
  if (!isset($config)) {
    $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/functions/data_access.ini");
  }
  return $config;
}

function db_connect() {

  $__config = get_config_data();
  $connection = mysqli_connect("localhost", $__config['username'], $__config['password']);

  if (!$connection) {
    return mysqli_connect_error();
  }

  return $connection;
}

function get_result_set($sql) {
  
  $rows = array();
  $__config = get_config_data();
  
  $connection = db_connect();

  if (isset($connection)) {

    mysqli_select_db($connection, $__config['dbname'])
        or die ("Unable to select database: " . mysqli_error ($connection));
    $result = mysqli_query($connection, $sql);

    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
      }
    } else echo "Unable to run query: " . mysqli_error($connection);

  } else echo "Cannot run query - connection not open. ";

  return $rows;
  
}

function get_result_set_prepared($sql, $args) {

  $rows = array();
  $__config = get_config_data();
  $connection = db_connect();

  if (isset($connection)) {

    mysqli_set_charset($connection, "utf8");
    mysqli_select_db($connection, $__config['dbname']);
    $statement = mysqli_prepare($connection, $sql);

    if ($statement) {

      mysqli_stmt_bind_param($statement, $args[0]["arg_type"], $args[0]["arg_value"]);
      mysqli_stmt_execute($statement);
      $result = mysqli_stmt_get_result($statement);
      while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
      }

    } else echo "Statement error: \"" . $sql . "\" - " . mysqli_error($connection);
  }

  return $rows;
  
}

/** Returns a JSON document given a SQL statement with question marks, an array of types (s, i, d, b) 
 * and a corresponding array of values as arguments. Uses connection parameters from config file. 
 * @param $sql
 * @param $arg_values
 * @param $arg_types
 * @return string
 */
function get_result_set_prepared_dynamic($sql, $arg_values, $arg_types) {
  
  $rows = array();
  $__config = get_config_data();
  $connection = db_connect();
  $args = array();
  
  if (isset($connection)) {

    mysqli_set_charset($connection, "utf8");
    
    mysqli_select_db($connection, $__config['dbname']);
    $statement = mysqli_prepare($connection, $sql);
    
    if ($statement) {
      
      $args[] = &$statement;
      $args[] = $arg_types;

      for ($i = 0; $i < count($arg_values); $i++) {
        $args[] = &$arg_values[$i];
      }
      
      call_user_func_array('mysqli_stmt_bind_param', $args);      
      mysqli_stmt_execute($statement);      
      $result = mysqli_stmt_get_result($statement);
      
      while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
      }      
    }    
  }
  
  return json_encode($rows);
  
}