<?php

	if(!isset($_SESSION)){
		session_start();
	}
	require_once("../carbon.php");
	$carbon = new Carbon();	
	
	$energy = $_POST['energy'];
	$transport = $_POST['transport'];
	$period = $_POST['period'];
	
	echo $energy;
	echo $transport;
	echo $period;

?>