<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	$period = $_POST['period'];
	
	$data;
	
	require_once("../carbon.php");
	$carbon = new Carbon();

	if($period == "all"){
		$data = $carbon->getAllOverviewStatistics();	
	}elseif($period == "year"){
		$data = $carbon->getYearOverviewStatistics($_POST['year']);
	}elseif($period == "month"){
		$data = $carbon->getMonthOverviewStatistics($_POST['year'], $_POST['month']);
	}elseif($period == "week"){
		$data = $carbon->getWeekOverviewStatistics($_POST['year'], $_POST['month'], $_POST['week']);
	}elseif($period == "day"){
		$data = $carbon->getDayOverviewStatistics($_POST['day']);
	}
	
	$result = array();;
	$result[0][0] = "Category";
	$result[0][1] = "Carbon Output (kge CO2)";
	$result[1][0] = "Energy";
	$result[1][1] = intval($data['energy']);
	$result[2][0] = "Transport";
	$result[2][1] = intval($data['transport']);
	$result[3][0] = "Lifestyle";
	$result[3][1] = intval($data['lifestyle']);
	
	echo json_encode($result);
?>