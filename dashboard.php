<!DOCTYPE html>

<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	require_once("files/standard/standard_includes.php");
?>

<html>
	<head>
		<title> Carbon Calculator Dashboard</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
	</head>
	
	<body>
	
		<?php require_once("files/navigation/secure_nav.php"); 
			
			echo($_SESSION['username']);
		?>
	
	</body>