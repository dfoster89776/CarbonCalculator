<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");

	$nonFriends = $carbon->friendsWhoUseApps();

	if($nonFriends != null){
	
		echo("<h3> Find Friends </h3>");
		foreach ($nonFriends as &$friend){
		    $response = $carbon->loadUserProfile($friend);
			echo("<div class='media'>");
			echo("<a class='pull-left' href='#'><img class='media-object' src='".$carbon->getOtherFacebookUserImageFromUserId($friend)."' width='64' height='64' alt='User Image'></a>");
			echo(" <div class='media-body'><h4 class='media-heading'>".$response['name']."</h4>
   <button id='add_".$friend."' onclick='addFriend(".$friend.")' class='btn btn-primary'> Add Friend </button>
  </div>");
  			echo("</div>");
		}
	}
?>