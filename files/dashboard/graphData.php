<?php

	if(!isset($_SESSION)){
		session_start();
	}
	require_once("../carbon.php");
	$carbon = new Carbon();	
	
	$energy = $_POST['energy'];
	$transport = $_POST['transport'];
	$period = $_POST['period'];
	
	$energyArray;
	$transportArray;
	
	$data = array();
	
	if($period == "week"){
		$data[0][0] = "Day";
	}
	elseif($period == "month"){
		$data[0][0] = "Week";
	}
	elseif($period == "year"){
		$data[0][0] = "Month";
	}
	
	if($energy == true){
		
		$energyArray = 1;
		
	}
	
	if($transport == true){
		if($energy == true){
			$transportArray = 2;
		}
		else{
			$transportArray = 1;
		}
	}
	
	
	$data[0][1] = 'Energy';
	$data[0][2] = 'Transport';
	$data[1][0] = 'Monday';
	$data[1][1] = 600;
	$data[1][2] = 700;
	$data[2][0] = 'Monday';
	$data[2][1] = 500;
	$data[2][2] = 900;

	
	
	
	echo json_encode($data);



?>