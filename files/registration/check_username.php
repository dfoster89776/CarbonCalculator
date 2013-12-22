<?php

session_start();

$myusername = $_POST['username'];
require '../database_connection/db_connection.php';
	
$tbl_name="users"; // Table name 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$myusername = mysql_real_escape_string($myusername);
$sql="SELECT username FROM users WHERE username = '$myusername'";
$result=mysql_query($sql);

if (mysql_num_rows($result) > 0){
	echo "true";		
}
else{
	echo "false";
}


	
?>