<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	require_once("../standard/standard_includes.php");

	$class_number = $_POST['class_number'];
	$data = $carbon->deleteClass($class_number);
?>

	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel" >Delete Class</h4>
	</div>
	<div class="modal-body" id="addClassModalBody">
		
		<?php
		
			if($data){
				echo("<div class='alert alert-success'><strong>Success!</strong> The class has been deleted. </div>");
			}else{
				echo("<div class='alert alert-success'><strong>Error!</strong>An error occurred, please try again.</div>");
			}
		
		?>
		
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>