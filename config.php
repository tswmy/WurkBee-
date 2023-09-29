<?php
ob_start();
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
$date_now = date('Y-m-d H:i:s');

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "wurkbee"; /* Database name */
$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}

$id=$_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM users WHERE id= '$id' ");
$fetch = mysqli_fetch_array($query);
$user_id=$fetch['id'];
$login_type=$fetch['login_type'];
$login_username=$fetch['username'];
$full_name=$fetch['full_name'];
$ph_num=$fetch['ph_num'];
?>


