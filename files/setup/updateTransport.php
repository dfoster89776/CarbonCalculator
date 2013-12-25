<?php 
	
	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();	
	
	if(isset($_POST['car_co2'])){
		$success = $carbon->updateTransport($_POST['car_co2']);	
	}else{
		$success = false;
	}
	
	if ($success){?>

		<div class="alert alert-success alert-dismissable" style="margin-top: 30px">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Success!</strong> Changes have been saved.
		</div>
		
	<?php
	}else{
		
	?>
		
		<div class="alert alert-danger alert-dismissable" style="margin-top: 30px">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Error!</strong> Changes could not be saved. Please try again.
		</div>
		
	<?php
	};

	
	include_once("transport.php");
?>