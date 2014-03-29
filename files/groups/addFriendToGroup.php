<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");

	$friend = $_POST['friend'];
	
	echo $carbon->addFriendToGroup($friend, $_SESSION['group_number']);
	
?>