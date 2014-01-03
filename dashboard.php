<!DOCTYPE html>

<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	require_once("files/standard/standard_includes.php");
	
	$data = $carbon->getDashboardData();
?>

<html>
	<head>
		<title> Carbon Calculator Dashboard</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script src="files/dashboard/dashboard.js"></script>
		<script>
		
			var data = <?php echo json_encode($data); ?>;
		
		</script>
	</head>
	
	<body onload="initialise()">
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-md-8" id="activity_container">
					
					<?php include_once("files/dashboard/activity.php"); ?>
									
				</div>
				
				<div class="col-md-3 col-md-offset-1">
					<p><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addJourney" style="width: 100%;">
					  Add Journey
					</button></p>
					<p><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addMeterReading" style="width: 100%;">
					  Add Meter Reading
					</button></p>
				</div>
			
			</div>
		
		</div>
	
	<!-- JOURNEY MODAL -->	
		<div class="modal fade" id="addJourney" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" onclick="resetJourneyModal()" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Add Journey</h4>
		      </div>
		      <div class="modal-body" id="journey_body">
		      	<?php include_once("files/dashboard/journey_modal.php"); ?>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="resetJourneyModal()">Close</button>
		        <button type="button" class="btn btn-primary" onclick="submitJourney()" id="journey_submit_button">Submit</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
		
		
	<!-- METER READING MODAL -->
		<div class="modal fade" id="addMeterReading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Add Meter Reading</h4>
		      </div>
		      <div class="modal-body" id="meter_body">
		      	<?php include_once("files/dashboard/meter_modal.php"); ?>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Submit</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
	</body>