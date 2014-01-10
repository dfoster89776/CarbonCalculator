<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();	

	if(isset($_POST['json'])){
		$success = $carbon->postMeter($_POST['json']);	
	}else{
		$success = false;
	}

	if ($success){?>
	
			<div class="alert alert-success alert-dismissable" style="margin-top: 30px">
			  <strong>Success!</strong> Changes have been saved.
			</div>
			
		<?php
		}else{
			
		?>
			
			<div class="alert alert-danger alert-dismissable" style="margin-top: 30px">
			  <strong>Error!</strong> Changes could not be saved. Please try again.
			</div>
			
		<?php
		};


?>