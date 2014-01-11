<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	
	$myusername=$_POST['username']; 
	$mypassword=$_POST['password']; 



	if($carbon->verifyUser($myusername, $mypassword)){
		$_SESSION['username'] = $myusername;
		$_SESSION['name']= $carbon->getUsersName();
		
		$carbon->updateLoginDate();
		
		if($carbon->getRegistrationStatus() == 10){
			header("location: ../../dashboard.php");
		}
		else{
			header("location: ../../registration.php");
		}
		
	}
	else{
		header("location: ../../index.php?invalid=true");
	}
	
?>