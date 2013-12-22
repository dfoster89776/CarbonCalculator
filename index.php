<!DOCTYPE html>

<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/checkLoginState.php");
	require_once("files/standard/standard_includes.php")
?>

<html>
	<head>
		<title> Carbon Calculator</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
	</head>
	
	<body style="padding-top: 100px; background:url('files/images/green.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
	
		<?php require_once("files/navigation/unsecure_nav.php"); ?>
	
		<div class="container">
  
			<div class="jumbotron">
			    <h1>St Andrews Carbon Calculator</h1>
			    <p>Welcome to the St. Andrews Carbon Calculator. Cut your carbon emissions with this application, by allowing you to monitor you're ongoing carbon emissions, set goals and share your achievements with your friends. </p>
			    <div class="row">
				  <div class="col-md-3"><a class="btn btn-primary btn-lg" style="min-width: 100%" href="about.php">Find Out More</a></div>
				  <div class="col-md-3"><a class="btn btn-success btn-lg" style="min-width: 100%" href="registration.php">Register Now</a></div>
				</div>
			</div>
			
		</div>
	
	</body>