<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	require_once("files/standard/standard_includes.php")
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Carbon Calculator Teaching </title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
	</head>
	
	<body>
	
		<?php require_once("files/navigation/secure_nav.php"); ?>
	
		<div class="container">
  
			<div class="row">
			
				<div class="col-md-3" id="classes_container">
			
				</div>
				
				<div class="col-md-8 col-md-offset-1" id="classes_detail_container">
				
				</div>
		</div>
	
	</body>