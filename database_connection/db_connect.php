<?php
	
	$host="drf8.host.cs.st-andrews.ac.uk"; // Host name 
	$username="drf8"; // Mysql username 
	$password="sK8e6kua"; // Mysql password 
	$db_name="drf8_db"; // Database name 
	
	if(isset($_SESSION['username'])){
		$myusername = $_SESSION['username'];
	}
	
	$con = mysqli_connect($host,$username,$password,$db_name);
	
	if (mysqli_connect_errno($con)){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>