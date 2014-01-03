<?php

session_start();

require_once("../carbon.php");
$carbon = new Carbon();

$myusername = $_POST['username'];
	
$exists = $carbon->checkUsernameExists($myusername);

if ($exists){
	echo "true";		
}
else{
	echo "false";
}


	
?>