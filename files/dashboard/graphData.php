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
	
	if($energy == "true"){
		
		$energyArray = 1;
		$data[0][1] = "Energy";
		
	}
	
	if($transport == "true"){
		if($energy == "true"){
			$data[0][2] = "Transport";
			$transportArray = 2;
		}
		else{
			$data[0][1] = "Transport";
			$transportArray = 1;
		}		
		
	}
	
	//Compute Dates
	if($period == "week"){
		
		for ($i = 1; $i <= 7; $i++) {
			$data[$i][0] = date("D", strtotime( '-'.(7-$i).' days' ) );
		}	
	}
	
	if($period == "month"){
		
		for ($i = 1; $i <= 7; $i++) {
			$data[$i][0] = date("W", strtotime( '-'.(8-$i).' weeks' ) );
		}	
	}
	
	if($period == "year"){
		
		for ($i = 1; $i <= 12; $i++) {
			$data[$i][0] = date("F", strtotime( '-'.(13-$i).' months' ) );
		}	
	}
	
	if($energy == "true"){
		if($period == "week"){
			$results = $carbon->getUsersEnergyLastWeek();
						
			for ($i = 1; $i <= 7; $i++) {
				$value;
				//echo $results[$i-1]['carbon_total'];
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$energyArray] = round($value, 2);
			    
			}	
		}
		elseif($period == "month"){
			
			$results = $carbon->getUsersEnergyLastMonth();
			
			for ($i = 1; $i <= 7; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$energyArray] = round($value, 2);
			}	
			
		}
		else{
			for ($i = 1; $i <= 7; $i++) {
				$data[$i][$energyArray] = 649;
			}
		}
	}
	
	if($transport == "true"){
		if($period == "week"){
			$results = $carbon->getUsersJourneysLastWeek();
			for ($i = 1; $i <= 7; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$transportArray] = round($value, 2);
			}	
		}
		elseif($period == "month"){
			
			$results = $carbon->getUsersJourneysLastMonth();
			
			for ($i = 1; $i <= 7; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$transportArray] = round($value, 2);
			}	
			
		}
		elseif($period == "year"){
			
		}
	}


	
	
	
	echo json_encode($data);



?>