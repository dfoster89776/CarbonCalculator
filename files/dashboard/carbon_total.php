<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();	

	$data['current'] = $carbon->carbonThisMonth();
	$data['previous'] = $carbon->carbonLastMonth();
	
	echo json_encode($data);

?>