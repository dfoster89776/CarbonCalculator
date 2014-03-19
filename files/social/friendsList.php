<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	require_once("../standard/standard_includes.php");
	require_once("../../facebook/facebook.php");
			
	$friends = $carbon->getFriendsList();
	
?>

<?php
						
	if ($friends != null){
		foreach ($friends as &$friend){
											
			echo ("<a href='profile.php?profile=".$friend['friend_username']."'><div class='col-xs-3' style='padding: 1px'>");
			echo ("<img src='".$carbon->getOtherFacebookUserImageFromUserId($friend['userid'])."' alt='user image' width='100%'>");
			echo("</div></a>");
		}
	}
?>