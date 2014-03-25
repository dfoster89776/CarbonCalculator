<?php
	
	$period = $_POST['period'];
	$year = $_POST['year'];
	$month = $_POST['month'];
	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();


	if($period != "all" && $period != "year" && $period != "month"){
	
		echo("<select class='form-control' id='weekOptions' onchange='updateDayOptions()' style='margin-top: 10px;'>");
			
		$options = $carbon->getWeekOptions($year, $month);	
		
		echo("<option value=''></option>");
		
		foreach($options as $week){
			
			echo("<option value='".$week['weekoption']."'>"."a"."</option>");
			
		}

		echo("</select>");
	}
	
	if($period == "day"){
		
		echo("<div id='dayoptions'></div>");
		
	}
	
?>