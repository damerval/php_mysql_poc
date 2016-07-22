<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 7/21/2016
 * Time: 2:47 PM
 */

$servername = "localhost";
$options = array("UID" => "sa", "PWD" => "7ofNine~", "Database" => "AdventureWorks2008R2");
$conn = sqlsrv_connect($servername, $options);

if ($conn === false) {
  die (print_r("Cannot connect.", true));
}

$sql = "SELECT DISTINCT Event "
          ."as Choice from vDatabaseLog order by Choice ";

$stmt = sqlsrv_query($conn, $sql);
$data = array();

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  $data[] = $row;
}

echo json_encode($data);


sqlsrv_close($conn);