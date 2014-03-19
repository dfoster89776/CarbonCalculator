<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	$connected = false;
	if (isset($_GET['tab'])){
		if($_GET['tab'] == 'connected'){
			$connected = true;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Account</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script src="files/account/account.js"></script>
	</head>
	
	<body>
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container" style="padding-top: 30px;">			
			<div class="row">
			  <div class="col-md-3" style="margin-bottom: 20px">
			  	  <div class="row hidden-xs">
					  <div class="col-md-12" style='text-align: center;'>
					  		<img src='<?php echo($carbon->getFacebookUserImage()); ?>' class='img-thumbnail'>					  			
					  </div>
				  </div>
				  <div class="row hidden-xs">
					  <div class="col-md-12" style='text-align: center;'>
					  		<?php echo("<h2>".$_SESSION['name']."</h2>"); ?>					  			
					  </div>
				  </div>
				  <div class="row">
					  <div class="col-md-12" style="margin-top: 20px;">				  
						  <ul class="nav nav-pills nav-stacked">
							  <li id="nav_overview" <?php if(!$connected){echo("class='active'");}?>><a onclick="displayOverview()">Overview</a></li>
							  <li id="nav_personal"><a onclick="displayPersonal()">Personal Details</a></li>
							  <li id="nav_connected"><a onclick="displayConnected()">Connected Accounts</a></li>
							  <li id="nav_class"><a onclick="displayClass()">Modules</a></li>
						  </ul>
					  </div>
				  </div>
			  </div>
			  <div class="col-md-8 col-md-offset-1" id="container">
				 
				  		<?php if($connected){include_once("files/account/connected_accounts.php");}else{include_once("files/account/overview.php");}?>
				  
			  </div>
			</div>
			
			
		</div>
	
	</body>