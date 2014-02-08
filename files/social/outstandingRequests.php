<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");

	$outstandingRequests = $carbon->getOutstandingRequests();


	if($outstandingRequests != null){
	
		echo("<h3> Outstanding Requests </h3>");
					
		foreach ($outstandingRequests as &$friend) {
			$userid = $carbon->getFacebookId($friend);
			echo("<div class='media' id='request_".$friend."'>");
			echo "<a class='pull-left'><img src='".$carbon->getOtherFacebookUserImageFromUserId($userid)."' height='64px' width='64px'></a>";
			$response = $carbon->loadUserProfile($userid);
			echo(" <div class='media-body'><h4 class='media-heading'>".$response['name']."</h4>
   <button id='confirm_".$friend."' onclick='confirmFriend(\"".$friend."\")' class='btn btn-primary' style='width: 40%'> Confirm </button>
   <button id='ignore_".$friend."' onclick='ignoreFriend(\"".$friend."\")' class='btn btn-warning' style='width: 40%'> Ignore </button>
  </div>");

			
			echo("</div>");
					}
	}						
?>