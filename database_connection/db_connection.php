<?php
	
	$host="drf8.host.cs.st-andrews.ac.uk"; // Host name 
	$username="drf8"; // Mysql username 
	$password="sK8e6kua"; // Mysql password 
	$db_name="drf8_db"; // Database name 
	
	if(isset($_SESSION['username'])){
		$myusername = $_SESSION['username'];
	}
	
	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");
?>