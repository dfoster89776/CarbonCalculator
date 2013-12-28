<?php 
	
	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();	
	$transportData = $carbon->getTransportData();	
?>


<!DOCTYPE html>


<div class='panel panel-default' style="margin-top: 30px">
	<div class='panel-heading'> Car </div>
	<div class='panel-body'; role='form'>
		<p> Please input the following details about your car's emissions. </p>
		<p> If you do not own a car you may continue and leave the field blank </p>
	</div> 
	<ul class='list-group'>
	<li class='list-group-item'>  
	<div class='form-horizontal' role='form'>
		<div class='form-group'>
		<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>CO2 Emissions for Vehicle in kg</label>
		<div class='col-lg-6'>
			<input type='text' class='form-control' id='kgeCO2' placeholder='<?php echo($transportData['car_co2']);?>'>
		</div>
		</div>
	</li>
	</ul>
</div>
</div>

<div class="row" style="margin-top: 30px; margin-bottom: 30px">
	<div  style='text-align: right'>
		<div class='col-md-offset-0 col-md-12'>
			<button class='btn-primary  btn btn-block' style='min-width: 100%' onclick='updateTransport()'>Save Changes</button>
		</div>
	</div>
</div>