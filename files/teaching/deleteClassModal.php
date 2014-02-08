<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	require_once("../standard/standard_includes.php");

	$class_number = $_POST['class_number'];
	$data = $carbon->getClassDetails($class_number);
?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel" >Delete Class</h4>
</div>
<div class="modal-body" id="addClassModalBody">
	<div class='form-horizontal' role='form'>
		<div class='form-group'>
			<label for='deleteClassNumber' class='col-md-offset-1 col-md-3 control-label'>Class Number</label>
			<div class='col-md-6'>
				<p class='form-control-static' id='deleteClassNumber'><strong><?php echo $class_number?></strong></p>
			</div>
		</div>
		<div class='form-group'>
			<label for='deleteModuleNumber' class='col-md-offset-1 col-md-3 control-label'>Class Number</label>
			<div class='col-md-6'>
				<p class='form-control-static' id='deleteModuleNumber'><?php echo $data['class_data']['module_number']?></p>
			</div>
		</div>
		<div class='form-group'>
			<label for='deleteSession' class='col-md-offset-1 col-md-3 control-label'>Class Number</label>
			<div class='col-md-6'>
				<p class='form-control-static' id='deleteSession'><?php echo $data['class_data']['session']?></p>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	<button type="button" class="btn btn-primary" id="classModalSubmit" onclick="confirmDelete('<?php echo $class_number ?>')">Confirm Deletion</button>
</div>
