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
		<title> Carbon Calculator History</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	</head>
	
	<body>
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container" >
		
			<div class="row">
				
				<div class="col-md-3 col-md-push-9" style="background: RGBA(22,128,18, 0.9); color: white; min-height: 100px; margin-top: 50px; padding-bottom: 15px;">
						<h2> Options </h2>
						<hr/>
						
						<select class="form-control">
						  <option>All</option>
						  <option>Year</option>
						  <option>Month</option>
						  <option>Week</option>
						  <option>Day</option>
						</select>
						
						<div id="suboption"></div>
				</div>
				
				<div class="col-md-8 col-md-pull-3">
					abcdefg
				</div>
			
			</div>
		
		</div>
	
	</body>