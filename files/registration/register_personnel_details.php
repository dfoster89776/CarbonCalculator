<?php

session_start();

require_once("../carbon.php");
$carbon = new Carbon();

$myusername = $_SESSION['username'];
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];

// To protect MySQL injection (more detail about MySQL injection)

$carbon->addPersonalDetails($firstname, $surname);

$_SESSION['name'] = $firstname." ".$surname;

echo("HERE");
	
?>