<?php

$con = new mysqli("localhost","root",123,"infotoday");
// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
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