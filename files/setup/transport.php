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
		<p> Please input details on your cars emissions. You can select either a preset average value or use the <a href='https://www.taxdisc.direct.gov.uk/EvlPortalApp/app/enquiry?execution=e3s2' target='_blank'> DVLA Vehicle Enquiry Site </a> to determine your vehicles exact emissions. The CO2 Emission values are given as g/km, so if 139 g/km, input as 0.139</p>
							<p> If you do not own a car, select 'No Car' in the dropdown.</p>
	</div> 
	<ul class='list-group'>
	<li class='list-group-item'>  
	<div class='form-horizontal' role='form'>
		<div class='form-group'>
			<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Car type</label>
			<div class='col-lg-6'>
				<select class='form-control' id='car_type' onchange='changeCarType()'>
				  <option <?php if($transportData['car_type'] == "none"){ echo "selected";}?>>No Car</option>
				  <option <?php if($transportData['car_type'] == "petrolSmall"){ echo "selected";}?>>Petrol - Small, up to 1.4 litre</option>
				  <option <?php if($transportData['car_type'] == "petrolMedium"){ echo "selected";}?>>Petrol - Medium, 1.4 to 2.0 litre</option>
				  <option <?php if($transportData['car_type'] == "petrolLarge"){ echo "selected";}?>>Petrol - Large, over 2.0 litre</option>
				  <option <?php if($transportData['car_type'] == "dieselSmall"){ echo "selected";}?>>Diesel - Small, up to 1.7 litre</option>
				  <option <?php if($transportData['car_type'] == "dieselMedium"){ echo "selected";}?>>Diesel - Medium, 1.7 to 2.0 litre</option>
				  <option <?php if($transportData['car_type'] == "dieselLarge"){ echo "selected";}?>>Diesel - Large, over 2.0 litre</option>
				  <option <?php if($transportData['car_type'] == "custom"){ echo "selected";}?>>Custom</option>
				</select>
			</div>
		</div>
		<div class='form-group'>
			<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>CO2 Emissions for Vehicle in kg</label>
			<div class='col-lg-6'>
				<input type='text' class='form-control' id='car_carbon' value='<?php echo($transportData['car_co2']);?>' onchange='setCustom()'>
			</div>
		</div>
	</li>
	</ul>
</div>
</div>

<div class="row" style="margin-top: 30px; margin-bottom: 30px">
	<div  style='text-align: right'>
		<div class='col-md-offset-0 col-md-12'>
			<button class='btn-success  btn btn-block' style='min-width: 100%' onclick='updateTransport()'>Save Changes</button>
		</div>
	</div>
</div>