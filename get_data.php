<?php
/**
 * Created by PhpStorm.
 * User: pdamerval
 * Date: 7/14/2016
 * Time: 3:54 PM
 */

if (session_status() === PHP_SESSION_NONE) { session_start(); }

$user_id = !empty($_SESSION) ? $_SESSION['user_id'] : "No session";
$user_name = !empty($_SESSION) ? $_SESSION['user_name'] : "";

echo $user_id . " - " . $user_name;