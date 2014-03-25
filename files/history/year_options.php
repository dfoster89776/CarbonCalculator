<?php
	
	$period = $_POST['period'];
	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();


	if($period != "all"){
	
		echo("<hr/>");
		
		echo("<select class='form-control' id='yearOptions' onchange='updateMonthOptions()' style='margin-top: 10px;'>");
			
		$options = $carbon->getYearOptions();	
		
		echo("<option value=''></option>");
		
		foreach($options as $year){
			
			echo("<option value='".$year['yearoption']."'>".$year['yearoption']."</option>");
			
		}

		echo("</select>");
	}
	
	if($period == "month" || $period == "week" || $period == "day"){
		
		echo("<div id='monthoptions'></div>");
		
	}
	
?>