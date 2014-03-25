<?php

		
	if(!isset($_SESSION['username'])){
		
		echo("<div class='page-header'>
					<h1>Registration <small>User Details</small></h1>
				</div>
				
				<div class='progress'>
					<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 0%;'>
						<span class='sr-only'>0% Complete</span>
					</div>
				</div>
				
				<br class='hidden-xs hidden-sm'/>
				
				<div id='alerts'> </div>
				
				<br class='hidden-xs hidden-sm'/>
				
				<div class='form-horizontal' role='form'>
					<div class='form-group' id='inputUsernameDiv'>
						<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Username</label>
						<div class='col-md-6'>
							<input type='email' class='form-control' id='inputUsername' placeholder='Username' onkeyup='checkUsername()'  onchange='checkUsername()'>
						</div>
					</div>
					<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>
					<div class='form-group' id='inputEmailDiv'>
						<label for='inputEmail1' class='col-md-3 col-md-offset-1 control-label'>Email</label>
						<div class='col-md-6'>
							<input type='email' class='form-control' id='inputEmail1' placeholder='Email' onkeyup='validateEmail()' onchange='validateEmail()'>
						</div>
					</div>
					<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>
					<div class='form-group' id='inputPasswordDiv'>
						<label for='inputPassword1' class='col-md-3 col-md-offset-1 control-label'>Password</label>
						<div class='col-md-6'>
							<input type='password' class='form-control' id='inputPassword1' placeholder='Password' onkeyup='checkPasswordStrength()' onchange='checkPasswordStrength()'>
						</div>
					</div>
					<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>
					<div class='form-group' id='inputPassword2Div'>
						<label for='inputPassword2' class='col-md-3 col-md-offset-1 control-label'>Re-type Password</label>
						<div class='col-md-6'>
							<input type='password' class='form-control' id='inputPassword2' placeholder='Re-type Password' onkeyup='checkPasswordMatch()' onchange='checkPasswordMatch()'>
						</div>
					</div>
				</div>
				
				<br class='hidden-xs'/><br class='hidden-xs'/><br class='hidden-xs'/>
				
				<div class='row' style='text-align: right'>
					<div class='col-md-offset-8 col-md-2'>
						<button class='btn-success  btn btn-block' style='min-width: 100%' onclick='submitLoginDetails()'>Continue</button>
					</div>
				</div>
				
				<br/><br/>");
		
	}else{
			
		if ($carbon->getRegistrationStatus() == 1){
			
					echo("
		
					<div class='page-header'>
						<h1>Registration <small>Personnal Details</small></h1>
					</div>
					
					<div class='progress'>
						<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 20%;'>
			   			<span class='sr-only'>20% Complete</span>
						</div>
					</div
					
					<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>
					
					<div id='alerts'/>
					
					<div class='form-horizontal; role='form'>
						<div class='form-group'>
							<label for='inputFirstname' class='col-lg-offset-1 col-lg-2 control-label'>Firstname</label>
							<div class='col-lg-6'>
								<input type='text' class='form-control' id='inputFirstname' placeholder='Firstname'>
							</div>
						</div>
						<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>
						<div class='form-group'>
							<label for='inputSurname' class='col-lg-2 col-lg-offset-1 control-label'>Surname</label>
							<div class='col-lg-6'>
								<input type='text' class='form-control' id='inputSurname' placeholder='Surname'>
							</div>
						</div>
					</div>
					<div class='row' style='text-align: right'>
						<div class='col-md-offset-2 col-md-8 col-lg-2 col-lg-offset-9'>
							<button class='btn-success  btn btn-block' style='min-width: 100%' onclick='submitPersonnalDetails()'>Continue</button>
						</div>
					</div>
					
					<br/><br/>");
			
		}


		if ($carbon->getRegistrationStatus() == 2){
			
				require_once("facebook/facebook.php");
			
				// Create our Application instance (replace this with your appId and secret).
				$facebook = new Facebook(array(
				  'appId'  => '1426418514240505',
				  'secret' => 'dc7b489953aef866c2a4a0bbc3657d17',
				));
				
				$myusername = $_SESSION['username'];
				
				$accesstoken = $carbon->getFacebookAccessToken();
				
				if($accesstoken != null){
					
					$facebook->setAccessToken($accesstoken);
					
				}
				
				// Get User ID
				$user = $facebook->getUser();
				
				// We may or may not have this data based on whether the user is logged in.
				//
				// If we have a $user id here, it means we know the user is logged into
				// Facebook, but we don't know if the access token is valid. An access
				// token is invalid if the user logged out of Facebook.
				
				if ($user) {
				  try {
				    // Proceed knowing you have a logged in user who's authenticated.
				    $user_profile = $facebook->api('/me');
				  } catch (FacebookApiException $e) {
				    error_log($e);
				    $user = null;
				  }
				}
				
				$params = array(
				  'scope' => 'read_stream, friends_likes, publish_actions',
				  'redirect_uri' => 'http://drf8.host.cs.st-andrews.ac.uk/Carbon/files/registration/register_facebook.php'
				);
				
				// Login or logout url will be needed depending on current user state.
				if ($user) {
				  $logoutUrl = $facebook->getLogoutUrl();
				} else {
				  $statusUrl = $facebook->getLoginStatusUrl();
				  $loginUrl = $facebook->getLoginUrl($params);
				}

				
				echo("<div class='page-header'>
						<h1>Registration <small>Connected Social Accounts</small></h1>
					</div>
					
					<div class='progress'>
						<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 40%;'>
			   			<span class='sr-only'>40% Complete</span>
						</div>
					</div
					
					<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>
					
					<div id='alerts'/>
					
					<div class='well'>
					
						<h2> Facebook </h2>");
					
					
					if ($user){
					
						echo("<div class='row' style='margin-top: 30px;'>
						 		 <div class='col-md-3' style='text-align: center'>
						 		 	<img src='https://graph.facebook.com/".$user."/picture?type=large' class='img-thumbnail'>
						 		 </div>
						 		 <div class='col-md-9'>
						 		 	<h3> Connected to Facebook as ".$user_profile['name']." </h3>
						 		 </div>
						 	  </div>");
											
					}
					else{
						
						echo("<a href=".$loginUrl."><img src='files/images/fbconnect.png' style='max-width: 100%'></a>");
						
					};
					
					
					echo("</div>
						
					<div class='row' style='text-align: right'>
						<div class='col-md-offset-2 col-md-8 col-lg-2 col-lg-offset-9'>
							<button class='btn-success  btn btn-block' style='min-width: 100%' onclick='submitSocialNetwork()'>Continue</button>
						</div>
					</div>
					
					<br/><br/>");
					
		}
		
		if ($carbon->getRegistrationStatus() == 3){
			
			echo("
		
					<div class='page-header'>
						<h1>Setup <small>Information</small></h1>
					</div>
					
					<div class='progress'>
						<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 60%;'>
			   			<span class='sr-only'>60% Complete</span>
						</div>
					</div
					
					<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>	
					
					<div class='panel panel-default'>
					  <div class='panel-body'>
					    <p>The following pages will guide you through the initial details required to use the carbon calculator.</p>
					    <p>If you do not know any information at this stage, you can leave the field blank and fill it in at a later date. </p>
					  </div>
					</div>
					
					<div class='row' style='text-align: right'>
						<div class='col-md-offset-2 col-md-8 col-lg-2 col-lg-offset-9'>
							<button class='btn-success  btn btn-block' style='min-width: 100%' onclick='submitSetupInfo()'>Continue</button>
						</div>
					</div>
					
					<br/><br/>");
					
		}
		
		if ($carbon->getRegistrationStatus() == 4){
			
			echo("
		
					<div class='page-header'>
						<h1>Setup <small>Transport</small></h1>
					</div>
					
					<div class='progress'>
						<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 60%;'>
			   			<span class='sr-only'>60% Complete</span>
						</div>
					</div
					
					<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>	
					
					<div id='alerts'/>
					<div class='panel panel-default'>
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
												  <option>No Car</option>
												  <option>Petrol - Small, up to 1.4 litre</option>
												  <option>Petrol - Medium, 1.4 to 2.0 litre</option>
												  <option>Petrol - Large, over 2.0 litre</option>
												  <option>Diesel - Small, up to 1.7 litre</option>
												  <option>Diesel - Medium, 1.7 to 2.0 litre</option>
												  <option>Diesel - Large, over 2.0 litre</option>
												  <option>Custom</option>
												</select>
											</div>
										</div>
										<div class='form-group'>
											<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>CO2 Emissions for Vehicle in kg</label>
											<div class='col-lg-6'>
												<input type='text' class='form-control' id='car_carbon'></input>
											</div>
										</div>
									</div>
								</li>
							</ul>
					</div>
					
					<div class='row' style='text-align: right'>
						<div class='col-md-offset-2 col-md-8 col-lg-2 col-lg-offset-9'>
							<button class='btn-success  btn btn-block' style='min-width: 100%' onclick='submitSetupOne()'>Continue</button>
						</div>
					</div>
					
					<br/><br/>");
					
		}
		
		if ($carbon->getRegistrationStatus() == 5){
			
			echo("
		
					<div class='page-header'>
						<h1>Setup <small>Energy</small></h1>
					</div>
					
					<div class='progress'>
						<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 80%;'>
			   			<span class='sr-only'>80% Complete</span>
						</div>
					</div
					
					<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>	
					
					<div id='alerts'/>
					
					<div class='panel panel-default'>
						<div class='panel-heading'> General </div>
						<div class='panel-body'; role='form'>
							<p> Please input the following details about your car's emissions. </p>
						</div>
							<ul class='list-group'>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='residents' class='col-lg-offset-1 col-lg-2 control-label'>Number of people in residence</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='residents' placeholder='Number of residents'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='electricity_meter' class='col-lg-offset-1 col-lg-2 control-label'>Initial Electricity Meter Reading</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='electricity_meter' placeholder='Electricity Meter Reading'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='gas_meter' class='col-lg-offset-1 col-lg-2 control-label'>Initial Gas Meter Reading</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='gas_meter' placeholder='Gas Meter Reading'>
										</div>
									</div>
								</li>
							</ul>
					</div>
										
					<div class='panel panel-default'>
						<div class='panel-heading'> Insulation </div>
						<div class='panel-body'; role='form'>
							<p> Please input the following details about your homes insulation statistics. </p>
							<p> Use Use http://www.resurgence.org/education/heac.html to find existing insulation losses and possible potential energy savings in your room or house. You can fill in numbers for the whole house or just your room - perhaps a thicker curtain or a draft excluder! </p>
						</div>
							<ul class='list-group'>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Walls</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='walls' placeholder='kWh per year of heat lost'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Roof</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='roof' placeholder='kWh per year of heat lost'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Windows/Doors</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='windows_doors' placeholder='kWh per year of heat lost'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Draughts</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='draughts' placeholder='kWh per year of heat lost'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Hot Water Tank</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='hot_water_tank' placeholder='kWh per year of heat lost'>
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
											<input type='text' class='form-control' id='boiler' placeholder='% efficiency'>
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
											<input type='text' class='form-control' id='thermostat' placeholder='Degrees C'>
										</div>
									</div>
								</li>
								<li class='list-group-item'>  
									<div class='form-horizontal' role='form'>
										<div class='form-group'>
										<label for='kgeCO2' class='col-lg-offset-1 col-lg-2 control-label'>Hours on Programmer per Day</label>
										<div class='col-lg-6'>
											<input type='text' class='form-control' id='hours' placeholder='Hours'>
										</div>
									</div>
								</li>
							</ul>
					</div>
					
					<div class='row' style='text-align: right'>
						<div class='col-md-offset-2 col-md-8 col-lg-2 col-lg-offset-9'>
							<button class='btn-success  btn btn-block' style='min-width: 100%' onclick='submitSetupTwo()'>Continue</button>
						</div>
					</div>
					
					<br/><br/>");
					
		}
		
		if ($carbon->getRegistrationStatus() == 6){
			
			echo("
		
					<div class='page-header'>
						<h1>Setup <small>Lifestyle</small></h1>
					</div>
					
					<div class='progress'>
						<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 100%;'>
			   			<span class='sr-only'>100% Complete</span>
						</div>
					</div
					
					<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>	
					
					<div id='alerts'/>
					
					<div class='form-horizontal; role='form'>
						<div class='form-group'>
							<label for='inputFirstname' class='col-lg-offset-1 col-lg-2 control-label'>Firstname</label>
							<div class='col-lg-6'>
								<input type='text' class='form-control' id='inputFirstname' placeholder='Firstname'>
							</div>
						</div>
					</div>
					
					<div class='row' style='text-align: right'>
						<div class='col-md-offset-2 col-md-8 col-lg-2 col-lg-offset-9'>
							<button class='btn-success  btn btn-block' style='min-width: 100%' onclick='submitSetupThree()'>Continue</button>
						</div>
					</div>
					
					<br/><br/>");
					
		}

		
    		
		if ($carbon->getRegistrationStatus() == 10){
				
			header("location: dashboard.php");
				
		}
		
	}
	
	
?>