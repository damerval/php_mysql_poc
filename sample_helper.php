<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 4/29/2016
 * Time: 3:31 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/functions/data_access.php");

$random_character = chr(rand(ord('A'), ord('Z')));

$random_character = "S";

echo get_result_set_prepared_dynamic(
    "select * from employee_view where LastName like ?",
    array($random_character . "%"),
    "s");
