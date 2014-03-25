<?php
	
	$period = $_POST['period'];
	$year = $_POST['year'];
	$month = $_POST['month'];
	$week = $_POST['week'];
	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();


	if($period != "all" && $period != "year" && $period != "month"){
	
		echo("<select class='form-control' id='dayOptions' style='margin-top: 10px;' onchange='updateData()'>");
			
		$options = $carbon->getDayOptions($year, $month, $week);	
		
		echo("<option value=''></option>");
		
		foreach($options as $day){
			echo("<option value='".$day['date']."'>".$day['date']."</option>");
		}

		echo("</select>");
	}	
?>