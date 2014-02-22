<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	$profile = $_SESSION['profile'];
	echo ($carbon->getActivityTotal($profile));	
?>