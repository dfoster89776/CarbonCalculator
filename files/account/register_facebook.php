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

header('location: ../../account.php?tab=connected');
?>
