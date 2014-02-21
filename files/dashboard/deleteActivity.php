<?php
	
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();	
	$success = $carbon->deleteActivity($_POST['id']);

	if($success){
		
	?>
		
		<div class="modal-header">
			Success
		</div>
		<div class="modal-body">
			<div class="alert alert-success">The activity has been successfully deleted.</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		</div>
	<?php
	}
	else
	{
	?>
	
		<div class="modal-header">
			Error
		</div>
		<div class="modal-body">
			<div class="alert alert-danger">An error occurred while trying to delete the activity. Please try again later.</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		</div>
		
	<?php
	};

?>