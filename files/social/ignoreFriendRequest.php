<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");

	echo($carbon->ignoreFriendRequest($_POST['friend_id']));

?>