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

function get_result_set_prepared($sql) {

  $rows = array();
  $__config = get_config_data();
  $connection = db_connect();

  if (isset($connection)) {

    mysqli_select_db($connection, $__config['dbname']);
    $param = "a%";
    $statement = mysqli_prepare($connection, $sql);

    if ($statement) {

      mysqli_stmt_bind_param($statement, "s", $param);
      mysqli_stmt_execute($statement);
      $result = mysqli_stmt_get_result($statement);
      while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
      }

    } else echo "Statement error: \"" . $sql . "\" - " . mysqli_error($connection);
  }

  return $rows;
  
}