<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();

	$data = $_POST['json'];
	
	$success = $carbon->postLifestyle($data);
	

?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Add Daily Lifestyle</h4>
</div>
<div class="modal-body" id="lifestyleModalBody">
	<div class="container">
		<?php
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
	</div>
</div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>