<!DOCTYPE html>

<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
?>

<html>
	<head>
		<title> Account</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
	</head>
	
	<body>
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container" style="margin-top: 50px">			
			<div class="row">
			  <div class="col-sm-3">
				  <div class="row">
					  <div class="col-md-12" style='text-align: center;'>
					  		<?php echo("<h3>".$_SESSION['name']."</h3>"); ?>					  			
					  </div>
				  </div>
				  <div class="row">
					  <div class="col-md-12" style="margin-top: 20px;">				  
						  <ul class="nav nav-pills nav-stacked">
							  <li id="nav_overview"><a href="#overview">Home</a></li>
							  <li id="nav_personal"><a href="#personal">Personal Details</a></li>
							  <li id="nav_connected"><a href="#connected">Connected Accounts</a></li>
						  </ul>
					  </div>
				  </div>
			  </div>
			  <div class="col-sm-8 col-sm-offset-1" id="overview"></div>
			</div>
			
			
		</div>
	
	</body>