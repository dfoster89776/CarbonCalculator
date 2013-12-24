<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();

	$carbon->removeFacebook();
	
	include_once("connected_accounts.php");
	
?>