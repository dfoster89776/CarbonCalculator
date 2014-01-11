<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	
	$class_code = $_POST['classcode'];
		
	$data = $carbon->removeClass($class_code);
		
	if($data == true){
				
		$returnData = array("success" => true);
				
	}
	else{
				
		$returnData = array("success" => false);
				
	}
	echo json_encode($returnData);

?>