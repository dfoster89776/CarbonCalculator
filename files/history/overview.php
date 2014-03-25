<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	$period = $_POST['period'];

	require_once("../carbon.php");
	$carbon = new Carbon();

	if($period == "all"){
		echo("<h1> Lifetime Overview</h1><div class='well'>");
					
		echo("</div>");
	}elseif($period == "year"){
		echo("<h1> Year Overview</h1><div class='well'>");
					
		echo("</div>");
		
	}elseif($period == "month"){
		echo("<h1> Month Overview</h1><div class='well'>");
					
		echo("</div>");
		
	}elseif($period == "week"){
		echo("<h1> Week Overview</h1><div class='well'>");
					
		echo("</div>");
		
	}elseif($period == "day"){
		echo("<h1> Day Overview</h1><div class='well'>");
					
		echo("</div>");
		
	}

?>