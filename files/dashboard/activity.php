<?php

	if(!isset($_SESSION)){
		session_start();
	}
	if (!isset($carbon)){
		require_once("../carbon.php");
		$carbon = new Carbon();	
	}
	
	echo("<h2> Latest Activity </h2>");
	

	$activity = $carbon->getLatestActivity();
						
	foreach ($activity as $value) {
	
		//If type is journey
		if ($value['type'] == "journey"){
		
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
	
   	}
			
?>