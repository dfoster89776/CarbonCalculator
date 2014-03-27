<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	$period = $_POST['period'];
	
	$data;
	
	require_once("../carbon.php");
	$carbon = new Carbon();

	if($period == "all"){
		echo("<h1> Lifetime Overview</h1><div class='well'>");
		$data = $carbon->getAllOverviewStatistics();
	
	}elseif($period == "year"){
		echo("<h1> Year Overview for ".$_POST['year']."</h1><div class='well'>");
		$data = $carbon->getYearOverviewStatistics($_POST['year']);
	
	}elseif($period == "month"){
		echo("<h1> Overview for </h1><div class='well'>");
		$data = $carbon->getMonthOverviewStatistics($_POST['year'], $_POST['month']);

	}elseif($period == "week"){
		echo("<h1> Overview</h1><div class='well'>");
		$data = $carbon->getWeekOverviewStatistics($_POST['year'], $_POST['month'], $_POST['week']);
	
	}elseif($period == "day"){
		echo("<h1> Overview</h1><div class='well'>");
		$data = $carbon->getDayOverviewStatistics($_POST['day']);
	}
	
	echo("<div class='row'>");
		echo("<div class='col-sm-6'>");
		
			echo("<div class='row'>");
				echo("<div class='col-sm-4'>");
				echo("<h1> Total </h1>");
				echo("</div>");
				echo("<div class='col-sm-8' style='text-align: center'>");
					echo("<h1>".round($data['total'], 2)."</h1>");
				echo("</div>");
			echo("</div>");
			echo("<div class='row'>");
				echo("<div class='col-sm-4'>");
				echo("<h4> Energy </h4>");
				echo("</div>");
				echo("<div class='col-sm-8' style='text-align: center'>");
					echo("<h4>".round($data['energy'], 2)."<small> kge CO2</small></h4>");
				echo("</div>");
			echo("</div>");
			echo("<div class='row'>");
				echo("<div class='col-sm-4'>");
				echo("<h4> Transport </h4>");
				echo("</div>");
				echo("<div class='col-sm-8' style='text-align: center'>");
					echo("<h4>".round($data['transport'], 2)."<small> kge CO2</small></h4>");
				echo("</div>");
			echo("</div>");
			echo("<div class='row'>");
				echo("<div class='col-sm-4'>");
				echo("<h4> Lifestyle </h4>");
				echo("</div>");
				echo("<div class='col-sm-8' style='text-align: center'>");
					echo("<h4>".round($data['lifestyle'], 2)."<small> kge CO2</small></h4>");
				echo("</div>");
			echo("</div>");
			
		echo("</div>");
		echo("<div class='col-sm-5 col-sm-offset-1'>");
			echo("<div id='piechart' style='width: 100%;' class='pull-right'></div>");
		echo("</div>");
	echo("</div>");
	
	//End of well
	echo("</div>");


?>