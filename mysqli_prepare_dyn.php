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
  
  $sql = "select * from employee_view where LastName like ?";
  
  $statement = mysqli_prepare($connection, $sql);
  
  $arg = "b%";
  
  mysqli_stmt_bind_param($statement, "s", $arg);
  
  mysqli_stmt_execute($statement);
  
  $result = mysqli_stmt_get_result($statement);
  
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return json_encode($rows);

}

echo get_data();