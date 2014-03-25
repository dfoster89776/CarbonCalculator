<?php
	
	$period = $_POST['period'];
	$year = $_POST['year'];
	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();


	if($period != "all" && $period != "year"){
	
		echo("<select class='form-control' id='monthOptions' onchange='updateWeekOptions()' style='margin-top: 10px;'>");
			
		$options = $carbon->getMonthOptions($year);	
		
		echo("<option value=''></option>");
		
		foreach($options as $month){
			
			echo("<option value='".$month['monthoption']."'>".date ("F", mktime(0,0,0,$month['monthoption'],1,0))."</option>");
			
		}

		echo("</select>");
	}
	
	if($period == "week" || $period == "day"){
		
		echo("<div id='weekoptions'></div>");
		
	}
	
?>