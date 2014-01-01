<?php
session_start();

require '../../facebook/facebook.php';
require '../carbon.php';
$carbon = new Carbon();

$facebook = new Facebook(array(
  'appId'  => '1426418514240505',
  'secret' => 'dc7b489953aef866c2a4a0bbc3657d17',
));

$user = $facebook->getUser();

if ($user){
	$accesstoken = $facebook->getAccessToken();	
	$carbon->setFacebookAccessToken($user, $accesstoken);
}

$ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => 'drf8.host.cs.st-andrews.ac.uk/Carbon/',
                                      'message' => 'has started using the St. Andrews Carbon Calculator.
                                      Sign up now for free.',
                                      'name' => 'St. Andrews Carbon Calculator',
                                      'caption' => 'St. Andrews Carbon Calculator'
									  
                                 ));

header('location: ../../registration.php');
?>
