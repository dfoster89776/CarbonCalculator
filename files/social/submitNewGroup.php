<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");

	$groupName = $_POST['groupName'];
	
	echo $carbon->addNewGroup($groupName);

?>