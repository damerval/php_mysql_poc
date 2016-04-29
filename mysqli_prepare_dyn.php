<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 4/25/2016
 * Time: 9:55 AM
 */
function get_data() {
  
  $__config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/functions/data_access.ini");
  
  $connection = mysqli_connect("localhost", $__config['username'], $__config['password']);
  
  $rows = array();
  
  mysqli_select_db($connection, $__config['dbname']);
  
  $sql = "select * from employee_view where LastName like ? or BirthDate > ? or JobTitle = ?
          order by FirstName";
  
  $statement = mysqli_prepare($connection, $sql);
  
  $arg_values = array('c%', '1982-01-01', 'Janitor');
  $arg_types = "sss";

  $args = array();
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

  return json_encode($rows);

}

// echo get_data();