<?php

/**
	Return graph data in format 2D array
*/

	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();	
	
	$energy = $_POST['energy'];
	$transport = $_POST['transport'];
	$lifestyle = $_POST['lifestyle'];
	$period = $_POST['period'];
	
	$energyArray;
	$transportArray;
	$lifestyleArray;
	
	$data = array();
	
	//Determine period
	if($period == "7days"){
		$data[0][0] = "Day";
	}
	elseif($period == "5weeks"){
		$data[0][0] = "Week";
	}
	elseif($period == "6months"){
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
	
	if($lifestyle == "true"){
		
		if ($energy == "true"){
			
			if($transport == "true"){
				$lifestyleArray = 3;
				$data[0][3] = "Lifestyle";
			}else{
				$lifestyleArray = 2;
				$data[0][2] = "Lifestyle";
			}
		}else{
			if($transport == "true"){
				$lifestyleArray = 2;
				$data[0][2] = "Lifestyle";
			}else{
				$lifestyleArray = 1;
				$data[0][1] = "Lifestyle";
			}
		}
	}
	
	//Compute Dates
	if($period == "7days"){
		
		for ($i = 1; $i <= 7; $i++) {
			$data[$i][0] = date("D", strtotime( '-'.(7-$i).' days' ) );
		}	
	}
	
	if($period == "5weeks"){
		
		for ($i = 1; $i <= 5; $i++) {
			$data[$i][0] = date("W", strtotime( '-'.(6-$i).' weeks' ) );
		}	
	}
	
	if($period == "6months"){
		
		for ($i = 1; $i <= 6; $i++) {
			$data[$i][0] = date("F", strtotime( '-'.(6-$i).' months' ) );
		}	
	}
	
	
	//Get energy date
	if($energy == "true"){
		if($period == "7days"){
			$results = $carbon->getUsersEnergyLastWeek(null);
						
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
		elseif($period == "5weeks"){
			
			$results = $carbon->getUsersEnergyLastMonth(null);
			for ($i = 1; $i <= 5; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$energyArray] = round($value, 2);
			}	
			
		}
		elseif($period == "6months"){
			$results = $carbon->getUsersEnergyLastYear(null);
			
			for ($i = 1; $i <= 6; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$energyArray] = round($value, 2);
			}	
		}
	}
	
	if($transport == "true"){
		if($period == "7days"){
			$results = $carbon->getUsersJourneysLastWeek(null);
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
		elseif($period == "5weeks"){
			
			$results = $carbon->getUsersJourneysLastMonth(null);
			
			for ($i = 1; $i <= 5; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$transportArray] = round($value, 2);
			}	
			
		}
		elseif($period == "6months"){
			$results = $carbon->getUsersJourneysLastYear(null);
			
			for ($i = 1; $i <= 6; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$transportArray] = round($value, 2);
			}	
		}
	}
	
	if($lifestyle == "true"){
		if($period == "7days"){
			$results = $carbon->getUsersLifestyleLastWeek(null);
			for ($i = 1; $i <= 7; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$lifestyleArray] = round($value, 2);
			}	
		}
		elseif($period == "5weeks"){
			
			$results = $carbon->getUsersLifestyleLastMonth(null);
			
			for ($i = 1; $i <= 5; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$lifestyleArray] = round($value, 2);
			}	
			
		}
		elseif($period == "6months"){
			$results = $carbon->getUsersLifestyleLastYear(null);
			
			for ($i = 1; $i <= 6; $i++) {
				$value;
				if($results[$i-1]['carbon_total']){
					$value = $results[$i-1]['carbon_total'];
				}else{
					$value = 0;
				}
			    $data[$i][$lifestyleArray] = round($value, 2);
			}	
		}
	}


	
	
	
	echo json_encode($data);



?>