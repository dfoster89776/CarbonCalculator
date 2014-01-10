<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");

	$nonFriends = $carbon->friendsWhoUseApps();

	if($nonFriends != null){
	
		echo("<div class='row'><h4> Find Friends </h4></div>");
		
		foreach ($nonFriends as &$friend) {
			echo("<div class='row'>");
			echo ("<div class='col-xs-2'><img src='".$carbon->getOtherFacebookUserImageFromUserId($friend)."' height='40px' width='40px'></div>");
		    $response = $carbon->loadUserProfile($friend);
		    echo ("<div class='col-xs-5'><strong>".$response['name']."</strong></div>");
		    echo "<div class='col-xs-5'><button id='add_".$friend."' onclick='addFriend(".$friend.")' class='btn btn-primary'> Add Friend </button></div>";
		    echo("</div>");
		}
	}						
?>