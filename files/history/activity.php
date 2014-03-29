<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	$period = $_POST['period'];
	
	$data;
			
	require_once("../carbon.php");
	$carbon = new Carbon();

	if($period == "all"){
		$data = $carbon->getAllActivity();
	
	}elseif($period == "year"){
		$data = $carbon->getYearActivity($_POST['year']);
	
	}elseif($period == "month"){
		$data = $carbon->getMonthActivity($_POST['year'], $_POST['month']);

	}elseif($period == "week"){
		$data = $carbon->getWeekActivity($_POST['year'], $_POST['month'], $_POST['week']);
	
	}elseif($period == "day"){
		$data = $carbon->getDayActivity($_POST['day']);
	}


	echo("<h1>Activities During Period </h1><div class='well'>");
	
	echo("<ul class='media-list'>");
							
		$count = 1;
		if ($data != null){
			foreach ($data as $activity) {
			
				echo("<div class='media' onclick='openActivityModal(\"".$activity['activity_id']."\")'>
				  		<div class='pull-left'>");
				  		
				//Display icon
				
				  	if($activity['type'] == "meter_reading"){
						echo("<image src='files/images/icon/icon-meter.png' width='80px'/>");
					}
					elseif($activity['type'] == "lifestyle"){
						echo("<image src='files/images/icon/icon-meter.png' width='80px'/>");
					}
					elseif ($activity['main_category'] == "car"){
						echo("<image src='files/images/icon/icon-car.png' width='80px'/>");
					}
					elseif ($activity['main_category'] == "motorcycle"){
						echo("<image src='files/images/icon/icon-bike.png' width='80px'/>");
					}
					elseif ($activity['main_category'] == "taxi"){
						echo("<image src='files/images/icon/icon-taxi.png' width='80px'/>");
					}
					elseif ($activity['main_category'] == "coach"){
						echo("<image src='files/images/icon/icon-bus.png' width='80px'/>");
					}
					elseif ($activity['main_category'] == "rail"){
						echo("<image src='files/images/icon/icon-train.png' width='80px'/>");
					}
					elseif ($activity['main_category'] == "plane"){
						echo("<image src='files/images/icon/icon-plane.png' width='80px'/>");
					}
					elseif ($activity['main_category'] == "ferry"){
						echo("<image src='files/images/icon/icon-ferry.png' width='80px'/>");
					}
	
				echo("  </div>
					    <div class='media-body' style='margin-left: 150px'>
					      <h2 class='media-heading'>");
					      
					if($activity['type'] == "meter_reading"){
						if($activity['meter_type'] == "gas"){
							echo("Gas Meter Reading");
						}
						elseif($activity['meter_type'] == "electricity"){
							echo("Electricity Meter Reading");
						}
					}
					elseif($activity['type'] == "lifestyle"){
						echo("Daily Lifestyle");
					}
					elseif ($activity['main_category'] == "car"){
						echo("Car Trip");
					}
					elseif ($activity['main_category'] == "motorcycle"){
						echo("Motorcycle Trip");
					}
					elseif ($activity['main_category'] == "taxi"){
						echo("Taxi Ride");
					}
					elseif ($activity['main_category'] == "coach"){
						echo("Coach Trip");
					}
					elseif ($activity['main_category'] == "rail"){
						echo("Rail Journey");
					}
					elseif ($activity['main_category'] == "plane"){
						echo("Flight");
					}
					elseif ($activity['main_category'] == "ferry"){
						echo("Ferry Trip");
					}
					      
				echo("</h2>
					      <div style='width: 60%'>");
					      
				if($activity['type'] == "meter_reading"){
	
					echo("<h4>Total Carbon Output: ".round($activity['carbon_total'], 2)."<small> kge CO2</small></h4>");
					echo("<h4>Daily Carbon Output: ".round($activity['carbon_per_day'], 2)."<small> kge CO2</small></h4>");
					echo("<h5>Conversion Rate: ".round($activity['conversion_rate'], 2)."</h5>");
					echo("<h5>New Reading: ".round($activity['reading'], 2)."</h5>");
					echo("<h5>Reading Period: ".$activity['reading_start']." - ".$activity['reading_end']."</h5>");
				}elseif($activity['type'] == "lifestyle"){
					echo("<h4>Total Carbon Output: ".round($activity['carbon_total'], 2)."<small> kge CO2</small></h4>");
					echo("<h5>Date: ".$activity['date']."</h5>");

					
				}elseif($activity['type'] == "journey"){
					echo("<h4>Total Carbon Output: ".round($activity['carbon_total'], 2)."<small> kge CO2</small></h4>");
					echo("<h5>Conversion Rate: ".round($activity['conversion_rate'], 2)."</h5>");
					echo("<h5>Journey Date: ".$activity['journey_date']."</h5>");
					echo("<h5>Distance: ".$activity['distance']."<small> km</small></h5>");
					if($activity['details'] != null){
						echo("<h5>Details: ".$activity['details']."</h5>");
					}
				}
	
	
	
				echo("    </div>
					    </div>
					  </div>");
		   	}
		}else{
			echo("<h2> No activity to display </h2>");
		}
	   	echo("</ul>");
	
	echo("</div>");	
?>