<?php

session_start();

require '../database_connection/db_connection.php';

$myusername = $_SESSION['username'];
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];

$tbl_name="users"; // Table name 

// To protect MySQL injection (more detail about MySQL injection)
$firstname = stripslashes($firstname);
$surname = stripslashes($surname);
$firstname = mysql_real_escape_string($firstname);
$surname = mysql_real_escape_string($surname);
$sql="UPDATE users SET firstname = '$firstname', surname = '$surname' WHERE username='$myusername'";
$result=mysql_query($sql);
$sql="UPDATE users SET registration = '2' WHERE username='$myusername'";
$result=mysql_query($sql);


$_SESSION['registration'] = 2;
$_SESSION['name'] = $firstname." ".$surname;

include_once("register.php");	

	
?>