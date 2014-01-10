<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();	
	$data = $carbon->getDashboardData();
	

	echo json_encode($data);
?>