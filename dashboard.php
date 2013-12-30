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
			
				<div class="col-md-8">
				
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
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Add Journey</h4>
		      </div>
		      <div class="modal-body">
		      
		        <div class='form-horizontal' role='form'>
					<div class='form-group' id='inputJourneyTypeDiv'>
						<label for='inputJourneyType' class='col-md-offset-1 col-md-3 control-label'>Category</label>
						<div class='col-md-6'>
						<select class='form-control' id="main_category" onchange="updateCategory()">
							<option value="car">Car</option>
							<option value="motorcycle">Motorcycle</option>
							<option value="taxi">Taxi</option>
							<option value="coach">Coach</option>
							<option value="rail">Rail</option>
							<option value="plane">Plane</option>
							<option value="ferry">Ferry</option>
						</select>
						</div>
					</div>
					<div class='form-group' id='subCategory' style="display: none;">
						<label for='inputJourneyType' class='col-md-offset-1 col-md-3 control-label'>Subcategory</label>
						<div class='col-md-6'>
						<select class='form-control' id="sub_category" onchange="updateSubCategory()">
							
						</select>
						</div>
					</div>
					<div class='form-group' id='inputUsernameDiv'>
						<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Date</label>
						<div class='col-md-6'>
							<input type='email' class='form-control' id='inputUsername' value='<?php echo date('d-m-Y'); ?>'>
						</div>
					</div>
					<div class='form-group' id='inputUsernameDiv'>
						<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Notes</label>
						<div class='col-md-6'>
							<textarea class='form-control' id='inputUsername' rows='5' style='max-width: 100%;'></textarea>
						</div>
					</div>
					<div class='form-group' id='inputUsernameDiv'>
						<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Distance (km)</label>
						<div class='col-md-6'>
							<input type='number' class='form-control' id='distance' placeholder='10' onchange="updateCarbon()">
						</div>
					</div>
					<div class='form-group' id='inputUsernameDiv'>
						<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Conversion Rate</label>
						<div class='col-md-6'>
							<p class='form-control-static' id='conversion_rate'> 0.0 </p>
						</div>
					</div>
					<div class='form-group' id='inputUsernameDiv'>
						<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Carbon</label>
						<div class='col-md-6'>
							<p class='form-control-static' id='carbon'> 0.0 </p>
						</div>
					</div>
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Submit</button>
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
		      <div class="modal-body">
		        <div class='form-horizontal' role='form'>
					<div class='form-group' id='inputUsernameDiv'>
						<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Utility</label>
						<div class='col-md-6'>
							<div class="btn-group" data-toggle="buttons">
							  <label class="btn btn-primary" onclick="chooseElectric()">
							    <input type="radio" name="options" id="electricity"> Electricity
							  </label>
							  <label class="btn btn-primary" onclick="chooseGas()">
							    <input type="radio" name="options" id="gas"> Gas
							  </label>
							</div>
						</div>
					</div>
					<div class='form-group' id='inputUsernameDiv'>
						<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Previous Reading</label>
						<div class='col-md-6'>
							<p class='form-control-static' id='previous_reading'> - </p>
						</div>
					</div>
					<div class='form-group' id='inputUsernameDiv'>
						<label for='inputReading' class='col-md-offset-1 col-md-3 control-label'>New Reading</label>
						<div class='col-md-6'>
							<input type='text' class='form-control' id='inputReading' placeholder='New Reading' onchange=''>
						</div>
					</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Submit</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
	</body>