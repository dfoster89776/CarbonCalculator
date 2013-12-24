<?php 
	
	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();	
	$energyData = $carbon->getEnergyData();	
?>

<div class='panel panel-default' style="margin-top: 30px">
						<div class='panel-heading'> General </div>
						<div class='panel-body'; role='form'>
							<p> Please input the following details about your car's emissions. </p>
						</div>
							<ul class='list-group'>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Number of people in residence</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='residents' placeholder='<?php echo($energyData['occupants']);?>'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Electricity footprint conversion factor</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='elec_factor' placeholder='<?php echo($energyData['electricity_factor']);?>'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Gas footprint conversion factor</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='gas_factor' placeholder='<?php echo($energyData['gas_factor']);?>'>
										</div>
									</div>
								</li>
							</ul>
					</div>
										
					<div class='panel panel-default'>
						<div class='panel-heading'> Insulation </div>
						<div class='panel-body'; role='form'>
							<p> Please input the following details about your homes insulation statistics. </p>
							<p>Use http://www.resurgence.org/education/heac.html to find existing insulation losses and possible potential energy savings in your room or house. You can fill in numbers for the whole house or just your room - perhaps a thicker curtain or a draft excluder! </p>
						</div>
							<ul class='list-group'>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Walls</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='walls' placeholder='<?php echo($energyData['heat_loss_wall']);?>'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Roof</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='roof' placeholder='<?php echo($energyData['heat_loss_roof']);?>'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Windows/Doors</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='windows_doors' placeholder='<?php echo($energyData['heat_loss_window']);?>'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Draughts</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='draughts' placeholder='<?php echo($energyData['heat_loss_draughts']);?>'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Hot Water Tank</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='hot_water_tank' placeholder='<?php echo($energyData['heat_loss_water_tank']);?>'>
										</div>
									</div>
								</li>
							</ul>

					</div>
					
					<div class='panel panel-default'>
						<div class='panel-heading'> Boiler Efficiency </div>
						<div class='panel-body'; role='form'>
							<p> Please input the following details about your car's emissions. </p>
							<p> If you do not own a car you may continue and leave the field blank </p>
						</div>
							<ul class='list-group'>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Boiler Efficiency</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='boiler' placeholder='<?php echo($energyData['boiler_efficiency']);?>'>
										</div>
									</div>
								</li>
							</ul>
					</div>
					
					<div class='panel panel-default'>
						<div class='panel-heading'> Room Thermostat </div>
						<div class='panel-body'; role='form'>
							<p> Please input the following details about your car's emissions. </p>
							<p> If you do not own a car you may continue and leave the field blank </p>
						</div>
							<ul class='list-group'>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Room Temperature Thermostat Setting</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='thermostat' placeholder='<?php echo($energyData['thermostat']);?>'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Hours on Programmer per Day</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='hours' placeholder='<?php echo($energyData['heating_hours']);?>'>
										</div>
									</div>
								</li>
							</ul>
					</div>