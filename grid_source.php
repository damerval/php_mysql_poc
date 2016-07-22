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

$sql = "select * from vDatabaseLog ";

if (!empty($_SESSION)) {
  switch ($_SESSION['user_id']) {
    case 3: $sql .= "WHERE [schema] = 'dbo'"; break;
    case 2: $sql .= "WHERE [schema] in ('dbo', 'Person', 'Production')"; break;
    case 1: break;
    default: $sql = "";
  }
} else $sql = "";

$event = "";

if (isset($_GET['event'])) {
  $event = $_GET['event'];
  if ($event != "All") {
    $sql .= " AND Event = ?";
  }
}

$stmt = sqlsrv_query($conn, $sql, array($event));
$data = array();

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  $data[] = $row;
}

echo json_encode($data);


sqlsrv_close($conn);