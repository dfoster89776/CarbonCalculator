<?php

	if(!isset($_SESSION)){
		session_start();
	}
	if (!isset($carbon)){
		require_once("../carbon.php");
		$carbon = new Carbon();	
	}
	
	echo("<div>");
	echo("<h3 class='page-header'>Your Latest Activity</h3>");
	

	$activity = $carbon->getLatestActivity();
					
	if ($activity){
							
		$count = 1;
							
		foreach ($activity as $value) {
		
			//If type is journey
			if ($value['type'] == "journey"){
				date_default_timezone_set('UTC'); 
				$oDate = new DateTime($value['date_added']);
				$sDate = $oDate->format("d/m/Y");
			
				echo("	<div class='media'>
						  <div class='media-body'>
						    <h4 class='media-heading'>Journey</h4>
						    	Carbon Output: ".round($value['carbon_total'], 2)."<br/>
						    	Conversion Rate: ".$value['conversion_rate']."<br/>
						    	Date: ".$sDate."
						  </div>
						</div>");
				
			}
			if ($value['type'] == "meter_reading"){
				date_default_timezone_set('UTC'); 
				$oDate = new DateTime($value['date_added']);
				$sDate = $oDate->format("d/m/Y");
				echo("	<div class='media'>
						  <div class='media-body'>
						    <h4 class='media-heading'>Meter Reading</h4>
						    	Carbon Output: ".round($value['carbon_total'], 2)."<br/>
						    	Conversion Rate: ".$value['conversion_rate']."<br/>
						    	Date: ".$sDate."
						  </div>
						</div>");

			}
			
			$count++;
			if($count > 5){ break; }
	   	}
	}else{
		echo("<h4> No activity to display </h4>");
	}			
	echo("</div>");
?>