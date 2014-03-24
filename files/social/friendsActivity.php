<?php

	if(!isset($_SESSION)){
		session_start();
	}
	if (!isset($carbon)){
		require_once("../carbon.php");
		$carbon = new Carbon();	
	}
	
	$start = $_POST['loaded'];
	
	echo("<div>");
	

	$activity = $carbon->getFriendsActivity($start);
					
	if ($activity){
						
		echo("<ul class='media-list'>");	
		
							
		foreach ($activity as $value) {
		
			echo("<div class='row activity_item' onclick='openActivityModal(\"".$value['id']."\")'>");

			
			//If type is journey
			if ($value['type'] == "journey"){
				date_default_timezone_set('UTC'); 
				$oDate = new DateTime($value['date_added']);
				$sDate = $oDate->format("d/m/Y");
			
				echo("
					<div class='col-xs-2'>
					");
					echo("<img src='".$carbon->getOtherFacebookUserImageFromUserId($carbon->getFacebookId($value['username']))."' width='70%'>");
				/**if ($value['main_category'] == "car"){
					echo("<image src='files/images/icon/icon-car.png' width='100%'/>");
				}
				elseif ($value['main_category'] == "motorcycle"){
					echo("<image src='files/images/icon/icon-bike.png' width='100%'/>");
				}
				elseif ($value['main_category'] == "taxi"){
					echo("<image src='files/images/icon/icon-taxi.png' width='100%'/>");
				}
				elseif ($value['main_category'] == "coach"){
					echo("<image src='files/images/icon/icon-bus.png' width='100%'/>");
				}
				elseif ($value['main_category'] == "rail"){
					echo("<image src='files/images/icon/icon-train.png' width='100%'/>");
				}
				elseif ($value['main_category'] == "plane"){
					echo("<image src='files/images/icon/icon-plane.png' width='100%'/>");
				}
				elseif ($value['main_category'] == "ferry"){
					echo("<image src='files/images/icon/icon-ferry.png' width='100%'/>");
				}*/
					
					
					
				echo("</div>
					<div class='col-xs-9'>
					<h4 class='media-heading'>");
					
				if ($value['main_category'] == "car"){
					echo("Car Trip");
				}
				elseif ($value['main_category'] == "motorcycle"){
					echo("Motorcycle Trip");
				}
				elseif ($value['main_category'] == "taxi"){
					echo("Taxi Ride");
				}
				elseif ($value['main_category'] == "coach"){
					echo("Coach Trip");
				}
				elseif ($value['main_category'] == "rail"){
					echo("Rail Journey");
				}
				elseif ($value['main_category'] == "plane"){
					echo("Flight");
				}
				elseif ($value['main_category'] == "ferry"){
					echo("Ferry Trip");
				}
					
					
					
				echo("</h4>
					      <h5>Carbon: ".round($value['carbon_total'], 2)." <small>kge CO2</small></h5>
					      <h5>Date: ".$sDate."</h5>
					</div>
				</div>");
							
			}
			if ($value['type'] == "meter_reading"){
				date_default_timezone_set('UTC'); 
				$oDate = new DateTime($value['date_added']);
				$sDate = $oDate->format("d/m/Y");
				
				echo("
					<div class='col-xs-2'>
					");
					echo("<img src='".$carbon->getOtherFacebookUserImageFromUserId($carbon->getFacebookId($value['username']))."' width='70%'>");
									
				/**echo("
					<div class='col-sm-1'>
						<image src='files/images/icon/icon-meter.png' width='100%'/>");*/
				echo("</div><div class='col-sm-9'>
						<h4 class='media-heading'>Meter Reading</h4>
					      <h5>Carbon: ".round($value['carbon_total'], 2)." <small>kge CO2</small></h5>
					</div>
				</div>");
			}
			if ($value['type'] == "lifestyle"){
				date_default_timezone_set('UTC'); 
				$oDate = new DateTime($value['date_added']);
				$sDate = $oDate->format("d/m/Y");
				
				echo("
					<div class='col-xs-2'>
					");
					echo("<img src='".$carbon->getOtherFacebookUserImageFromUserId($carbon->getFacebookId($value['username']))."' width='70%'>");
									
				/**echo("
					<div class='col-sm-1'>
						<image src='files/images/icon/icon-meter.png' width='100%'/>");*/
				echo("</div><div class='col-sm-9'>
						<h4 class='media-heading'>Lifestyle</h4>
					      <h5>Carbon: ".round($value['carbon_total'], 2)." <small>kge CO2</small></h5>
					</div>
				</div>");
			}
			
	   	}
	   	echo("</ul>");
	}else{
		echo("<h4> No activity to display here</h4>");
	}			
	echo("</div>");
?>