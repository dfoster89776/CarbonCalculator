<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	
	$class_code = $_POST['classcode'];
	
	$data = $carbon->getClassDetails($class_code);
		
	echo json_encode($data);
?>