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
	</head>
	
	<body>
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-md-8">
				
				</div>
				
				<div class="col-md-3 col-md-offset-1">
					<p><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addJourney" style="width: 100%;">
					  Add Journey
					</button></p>
					<p><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addJourney" style="width: 100%;">
					  Add Meter Reading
					</button></p>
				</div>
			
			</div>
		
		</div>
		
		<div class="modal fade" id="addJourney" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Add Journey</h4>
		      </div>
		      <div class="modal-body">
		        ...
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Submit</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
	</body>