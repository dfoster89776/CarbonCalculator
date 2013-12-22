<?php
if(!isset($_SESSION['username'])){
	header("location: index.php");
}
else if ($carbon->getRegistrationStatus() != 10){
		header("location: ../registration.php");
}
?>
