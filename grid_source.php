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
$servername = "localhost";
$options = array("UID" => "sa", "PWD" => "7ofNine~", "Database" => "AdventureWorks2008R2");
$conn = sqlsrv_connect($servername, $options);

if ($conn === false) {
  die (print_r("Cannot connect.", true));
}

$sql = "SELECT DatabaseLogID, PostTime, DatabaseUser, Event, [Schema], Object, TSQL FROM DatabaseLog WHERE Event LIKE ?";
$criterion = "%TABLE%";
$stmt = sqlsrv_query($conn, $sql, array($criterion));
$data = array();

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  $data[] = $row;
}

echo json_encode($data);


sqlsrv_close($conn);