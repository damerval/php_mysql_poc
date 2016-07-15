<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 4/25/2016
 * Time: 9:16 AM
 **/
/*
$a = 2;
$b = $a * 2;
$c = $b * 4;
echo $c;
*/

session_start();

$servername = "localhost";
$options = array("UID" => "sa", "PWD" => "7ofNine~", "Database" => "AdventureWorks2008R2");
$conn = sqlsrv_connect($servername, $options);

if ($conn === false) {
  die (print_r("Cannot connect.", true));
}

$sql = "select * from vDatabaseLog WHERE [Schema] = 'dbo' ";

if (!empty($_SESSION)) {
  switch ($_SESSION['user_id']) {
    case 3: break;
    case 2: $sql .= "OR Event = 'CREATE_TABLE' "; break;
    case 1: $sql .= "OR Event like ? "; break;
    default: $sql = "";
  }
} else $sql = "";

$criterion1 = "%ALTER%";
$stmt = sqlsrv_query($conn, $sql, array($criterion1));
$data = array();

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  $data[] = $row;
}

echo json_encode($data);


sqlsrv_close($conn);