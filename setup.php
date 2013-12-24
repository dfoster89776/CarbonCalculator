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
		<script src="files/setup/setup.js"></script>
	</head>
	
	<body onload="loadEnergy()">
	
		<?php require_once("files/navigation/secure_nav.php");?>
		
		<div class="container">
  			
  			<h1> Setup Details </h1>
  			
			<ul class="nav nav-pills">
			  <li id="nav_energy"><a onclick="loadEnergy()">Energy</a></li>
			  <li id="nav_transport"><a onclick="loadTransport()">Transport</a></li>
			  <li id="nav_lifestyle"><a onclick="loadLifestyle()">Lifestyle</a></li>
			</ul>
			
		</div>
		
		<div class="container" id="container"></div>

	
	</body>