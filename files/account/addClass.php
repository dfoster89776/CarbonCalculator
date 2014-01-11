<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	
	$class_code = $_POST['classcode'];
	
	$data = $carbon->joinClass($class_code);
		
	if($data == true){
		
		$html = "<div class='alert alert-success'><strong>Success!</strong> You have enrolled in the class.</div>";
		
		$returnData = array("success" => true, "html" => $html);
				
	}
	else{
		
		$html = "<div class='alert alert-success'><strong>Error!</strong>An error occurred, please try again.</div>";
		
		$returnData = array("success" => false, "html" => $html);
				
	}
	
	echo json_encode($returnData);

?>