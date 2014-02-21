<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	require_once("files/standard/standard_includes.php");
?>
<!DOCTYPE html>

<html>
	<head>
		<title> Carbon Calculator Dashboard</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script src="files/dashboard/dashboard.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>

	</head>
	
	<body onload="initialise()">
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container">
		
			<div class="row">
				
				<div class="col-md-3 col-md-push-9">
					<br/>
					<p><button class="btn btn-primary btn-lg" style="width: 100%;" onclick="openJourneyModal()">
					  Add Journey
					</button></p>
					<p><button class="btn btn-primary btn-lg" data-toggle="modal" onclick="openMeterModal()" style="width: 100%;">
					  Add Meter Reading
					</button></p>
					<div id="activity_container"><div style="text-align: center; padding-top: 100px;"><img src='files/images/loading.gif' id='loading-indicator'/></div>
					</div>
					
				</div>
				
				<div class="col-md-8 col-md-pull-3">
					<h1 class="page-header">Dashboard</h1>
					<div id="statistics"><div style="text-align: center; padding-top: 100px;"><img src='files/images/loading.gif' id='loading-indicator'/></div></div>
				</div>
				
				<div class="col-md-8 col-md-pull-3" style="margin-top: 50px;">
					<h1 class="page-header">History</h1>
					<div id="statistics"><div style="text-align: center; padding-top: 100px;"><img src='files/images/loading.gif' id='loading-indicator'/></div></div>
				</div>
			
			</div>
		
		</div>
	
	<!-- JOURNEY MODAL -->	
		<div class="modal fade" id="addJourney" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content" id="addJourneyModal">
		   </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
		
		
	<!-- METER READING MODAL -->
		<div class="modal fade" id="addMeterReading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content" id="addMeterModal">
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	

	<!-- ACTIVITY MODAL -->
		<div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content" id="activityModalContent">
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	


	</body>