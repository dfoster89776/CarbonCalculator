<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	require_once("../standard/standard_includes.php");
?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" onclick="resetMeterModal()" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel">Add Meter Reading</h4>
</div>
<?php

	$data = $carbon->getMeterData();
	if((date('Ymd') == date('Ymd', strtotime($data['electricity_date']))) && (date('Ymd') == date('Ymd', strtotime($data['gas_date'])))){
?>

		<div class="modal-body" id="meter_body">
		
			<h3> Both gas and electricity meter readings are up to date. Please try again from tomorrow. <h3>
		
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		
<?php		
	}else{

?>

<div class="modal-body" id="meter_body">
	<div class='form-horizontal' role='form'>
		<div id="alerts">
			
		</div>
		<div class='form-group' id='inputUsernameDiv'>
			<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Utility</label>
			<div class='col-md-6'>
				<div class="btn-group" data-toggle="buttons">
				
				<?php 
					if(date('Ymd') != date('Ymd', strtotime($data['electricity_date']))){
				?>
				
				  <label class="btn btn-success" onclick="chooseElectric()">
				    <input type="radio" name="options" id="electricity"> Electricity
				  </label>
				  
				 <?php
				 	}
				 	if (date('Ymd') != date('Ymd', strtotime($data['gas_date']))){
				 ?>
				  <label class="btn btn-success" style="margin-left: 5px;" onclick="chooseGas()">
				    <input type="radio" name="options" id="gas"> Gas
				  </label>
				  
				  <?php } ?>
				</div>
			</div>
		</div>
		<div class='form-group' id='occupantsDiv'>
			<label for='occupants' class='col-md-offset-1 col-md-3 control-label'>No. of Occupants</label>
			<div class='col-md-6'>
				<input type='text' class='form-control' id='occupants' value='4' onchange='updateMeterModal()'>
			</div>
		</div>
		<div class='form-group' id='previousReadingDiv'>
			<label for='meterPrevious' class='col-md-offset-1 col-md-3 control-label'>Previous Reading</label>
			<div class='col-md-6'>
				<p class='form-control-static' id='meterPrevious'> - </p>
			</div>
		</div>
		<div class='form-group' id='inputReadingDiv'>
			<label for='meterInputReading' class='col-md-offset-1 col-md-3 control-label'>New Reading</label>
			<div class='col-md-6'>
				<input type='text' class='form-control' id='meterInputReading' placeholder='New Reading' onchange='updateMeterModal()' disabled='true'>
			</div>
		</div>
		<div class='form-group' id='amountUsedDiv'>
			<label for='meterUsedAmount' class='col-md-offset-1 col-md-3 control-label'>Amount Used</label>
			<div class='col-md-6'>
				<p class='form-control-static' id='meterUsedAmount'> - </p>
			</div>
		</div>
		<div class='form-group' id='carbonOutput'>
			<label for='meterCarbon' class='col-md-offset-1 col-md-3 control-label'>Total Carbon Output</label>
			<div class='col-md-6'>
				<p class='form-control-static' id='meterCarbon'> - </p>
			</div>
		</div>
		<div class='form-group' id='carbonOutputPerson'>
			<label for='meterCarbonPerson' class='col-md-offset-1 col-md-3 control-label'>Carbon Output Per Person</label>
			<div class='col-md-6'>
				<p class='form-control-static' id='meterCarbonPerson'> - </p>
			</div>
		</div>
	</div>
 </div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success" onclick="submitMeter()" id="meter_submit_button">Submit</button>
</div>

<?php } ?>