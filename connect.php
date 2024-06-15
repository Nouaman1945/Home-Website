<?php


$host = "localhost";
$username="root";
$password="";
$database = "ecommerce";

$con = mysqli_connect($host, $username, $password, $database);
// if (!$con) {
// 	die("database connection failed" . mysqli_error($con));
// }

// $select_db = mysqli_select_db($con, 'php_crud_app');
// if (!$select_db) {
// 	die("database selected failed" . mysqli_error($con));
// }
?>