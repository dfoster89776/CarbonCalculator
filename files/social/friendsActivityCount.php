<?php

	if(!isset($_SESSION)){
		session_start();
	}
	if (!isset($carbon)){
		require_once("../carbon.php");
		$carbon = new Carbon();	
	}

	echo $carbon->getFriendsActivityCount();
					
	
?>