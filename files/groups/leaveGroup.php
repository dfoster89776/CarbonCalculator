<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	require_once("../standard/standard_includes.php");

	$carbon->leaveGroup($_POST['groupNo']);			
	echo true;
?>