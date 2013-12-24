<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(file_exists("../carbon.php")){
		require_once("../carbon.php");
		require_once("../../facebook/facebook.php");
	}else{
		require_once("files/carbon.php");
		require_once("facebook/facebook.php");
	}
	
	$carbon = new Carbon();
		
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '1426418514240505',
	  'secret' => 'dc7b489953aef866c2a4a0bbc3657d17',
	));
	
	$myusername = $_SESSION['username'];
	$user = null;
	$accesstoken = $carbon->getFacebookAccessToken();
	if($accesstoken != null){
		
		$facebook->setAccessToken($accesstoken);
		$user = $facebook->getUser();
	}
	
	// Get User ID
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
	    // Proceed knowing you have a logged in user who's authenticated.
	    $user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
	    error_log($e);
	    $user = null;
	  }
	}
	
	$params = array(
	  'scope' => 'read_stream, friends_likes, publish_actions',
	  'redirect_uri' => 'http://drf8.host.cs.st-andrews.ac.uk/Carbon/files/account/register_facebook.php'
	);
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $logoutUrl = $facebook->getLogoutUrl();
	} else {
	  $statusUrl = $facebook->getLoginStatusUrl();
	  $loginUrl = $facebook->getLoginUrl($params);
	}

	if ($user){
					
		echo("<div class='col-md-12'>
		 		 <h3> Connected to Facebook as ".$user_profile['name']." </h3>
		 		 <a onclick='removeFacebook()'> Remove Facebook Account </a>
		 	  </div>");
							
	}
	else{
		
		echo("<div class='col-md-12'>
		 		 <h3> Not currently connected to Facebook. </h3>
		 		 <a href=".$loginUrl."><img src='files/images/fbconnect.png' style='max-width: 100%'></a>
		 	  </div>");
		
	};

	
	
?>