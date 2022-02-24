<?php

// $con = new mysqli("localhost","root",123,"infotoday");
$con=mysqli_init();
mysqli_ssl_set($con, NULL, NULL, {ca-cert filename}, NULL, NULL);
mysqli_real_connect($con, "rmskwebdb.mysql.database.azure.com", "ruvindu@rmskwebdb", "rmsk@456", "infotoday", 3306);
// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}else{
  echo "success";
}

/*
// Create connection
$con = mysqli_connect("localhost","id13972875_admin_infotoday","8+[QB$0MqJ0Z%OXD","id13972875_infotoday");

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
*/

?>
