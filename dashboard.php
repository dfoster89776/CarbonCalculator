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
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" src="files/dashboard/dashboard.js"></script>

	</head>
	
	<body onload="initialise()">
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container" >
		
			<div class="row">
				
				<div class="col-md-3 col-md-push-9" style="margin-top: 40px;">
					<br/>
					<p><button class="btn btn-success btn-lg" style="width: 100%;" onclick="openJourneyModal()">
					  Add Journey
					</button></p>
					<p><button class="btn btn-success btn-lg" data-toggle="modal" onclick="openMeterModal()" style="width: 100%;">
					  Add Meter Reading
					</button></p>
					<div id="activity_container"><div style="text-align: center; padding-top: 100px;"><img src='files/images/loading.gif' id='loading-indicator'/></div>
					</div>
				</div>
				
				<div class="col-md-8 col-md-pull-3">
					<h1 class="page-header">Overview</h1>
					<div id="statistics" class="well"><div style="text-align: center; padding-top: 100px;"><img src='files/images/loading.gif' id='loading-indicator'></div></div>
					<h1 class="page-header" style='margin-top: 50px;'>History</h1>
					<div class="well">
					<div class="btn-group" data-toggle="buttons">
					  <label class="btn btn-success active">
					    <input id="energyCheck" type="checkbox" onchange="updateGraph()" checked> Energy
					  </label>
					  <label class="btn btn-success active">
					    <input id="transportCheck" type="checkbox" onchange="updateGraph()" checked> Transport
					  </label>
					</div>
					
					<div class="btn-group pull-right" data-toggle="buttons">
					  <label class="btn btn-success">
					    <input type="radio" name="options" id="option1" value="7days" onchange="updateGraph()"> 7 Days
					  </label>
					  <label class="btn btn-success">
					    <input type="radio" name="options" id="option2" value="5weeks" onchange="updateGraph()"> 1 Month
					  </label>
					  <label class="btn btn-success active">
					    <input type="radio" name="options" id="option3" value="6months" onchange="updateGraph()" checked> 6 Months
					  </label>
					</div>
					
					
					<div id="chart_div" style="height: 500px; margin-top: 20px"><div style="text-align: center; padding-top: 100px;"><img src='files/images/loading.gif' id='loading-indicator'></div></div></div>
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