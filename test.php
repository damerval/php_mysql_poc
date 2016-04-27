<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 4/25/2016
 * Time: 9:54 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/functions/data_access.php");

$sql = "select * from (select * from employee where LAST_NAME like 'b%') a order by LAST_NAME";

$sql_prepared = "select * from (select * from employee where LAST_NAME like ?) a order by LAST_NAME";

$rows = get_result_set_prepared($sql_prepared);

echo json_encode($rows);


