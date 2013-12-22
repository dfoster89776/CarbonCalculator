<?php

session_start();

require '../database_connection/db_connection.php';
	
$tbl_name="users"; // Table name 
 
$myusername = $_SESSION['username'];

// To protect MySQL injection (more detail about MySQL injection)
$sql="UPDATE users SET registration = '10' WHERE username='$myusername'";
$result=mysql_query($sql);

$_SESSION['registration'] = 10;

header("location: ../../dashboard.php");
	
?>