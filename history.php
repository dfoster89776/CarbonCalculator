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
		<script type="text/javascript" src="files/history/history.js"></script>
	</head>
	
	<body onload="updateData()">
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container" >
		
			<div class="row">
				
				<div class="col-md-2 col-md-push-10" style="background: RGBA(22,128,18, 0.9); color: white; min-height: 100px; margin-top: 50px; padding-bottom: 15px;">
						<h2> Options </h2>
						<hr/>
						
						<select class="form-control" onchange="updateYearOptions()" id="mainOptions">
						  <option value="all">All</option>
						  <option value="year">Year</option>
						  <option value="month">Month</option>
						  <option value="week">Week</option>
						  <option value="day">Day</option>
						</select>
						
						<div id="yearoptions"></div>
				</div>
				
				<div class="col-md-9 col-md-pull-2" style="margin-top: 50px;" id="overview">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" id="histogram">
					<h1> Month Histogram</h1>
					<div class="well">
					
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" id="activity">
				<h1> Month's Activities </h1>
					<div class="well">
					
					</div>
				</div>
			</div>
		
		</div>
		
		<!-- ACTIVITY MODAL -->
		<div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content" id="activityModalContent">
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	



	
	</body>