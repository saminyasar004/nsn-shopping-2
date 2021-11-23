<?php

/**
 * database connection setup in this file
 */

session_start();
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "e-commerce";
$timezone = "Asia/Dhaka";
$time_format = "d M Y";
$currency = "$";
$limit = 10;
date_default_timezone_set($timezone);

$connect = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$connect) die("Connection Failed!" . mysqli_error($connect));
