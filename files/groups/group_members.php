<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	
	$data = $carbon->getGroupMembers($_SESSION['group_number']);
	
	if ($data){
		
		foreach($data as $member){
			echo("<a href='profile.php?profile=".$member['username']."'><div class='row' style='margin-bottom: 5px'>");
		
			echo("<div class='col-xs-3'><img class='media-object' src='".$carbon->getOtherFacebookUserImageFromUserId($member['userid'])."' alt='...' width='60px'></div>");
			
			echo("<div class='col-xs-9'><h3>".$member['firstname']." ".$member['surname']."</h3></div>");
			
			echo("</div></a>");
		}
		
	}else{
		echo("<h3> No friends in group currently </h3>");
	}
	
?>