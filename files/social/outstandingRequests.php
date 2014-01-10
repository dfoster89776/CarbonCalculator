<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");

	$outstandingRequests = $carbon->getOutstandingRequests();


	if($outstandingRequests != null){
	
		echo("<div class='row'><h4> Outstanding Requests </h4></div>");
					
		foreach ($outstandingRequests as &$friend) {
			$userid = $carbon->getFacebookId($friend);
			echo("<div class='row' id='request_".$friend."'>");
			echo "<div class='col-xs-3'><img src='".$carbon->getOtherFacebookUserImageFromUserId($userid)."' height='40px' width='40px'></div>";
			$response = $carbon->loadUserProfile($userid);
			echo ("<div class='col-xs-9'><h5>".$response['name']."</h5></div>");
			echo ("</div>");
			echo("<div class='row' id='request_".$friend."' style='margin-top: 5px'>");
			echo ("<div class='col-xs-6'>");
			echo "<button id='confirm_".$friend."' onclick='confirmFriend(\"".$friend."\")' class='btn btn-primary' style='width: 100%'> Confirm </button>";
			echo ("</div>");
			echo ("<div class='col-xs-6'>");
			echo "<button id='ignore_".$friend."' onclick='ignoreFriend(\"".$friend."\")' class='btn btn-warning' style='width: 100%'> Ignore </button>";
			echo ("</div>");
			echo ("</div>");
		}
	}						
?>