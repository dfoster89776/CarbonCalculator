<?php

require_once("../carbon.php");
$carbon = new Carbon();

session_start();

$myusername = $_POST['username'];
$mypassword = md5($_POST['password']);
$myemail = $_POST['email'];
$invalidUsername = false;

if ($carbon->checkUsernameExists($myusername)){
	echo("no");
}else{
	$carbon->addUser($myusername, $mypassword, $myemail);
	$_SESSION['username'] = $myusername;
}


	
?>