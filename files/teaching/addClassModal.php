<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
?>	

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel" >Register New Class</h4>
</div>
<div class="modal-body" id="addClassModalBody">
	<div class='form-horizontal' role='form'>
		<div class='form-group'>
			<label for='moduleNumber' class='col-md-offset-1 col-md-3 control-label'>Module Number</label>
			<div class='col-md-6'>
				<input type='text' class='form-control' id='moduleNumber' maxlength="15" >
			</div>
		</div>
		<div class='form-group'>
			<label for='session' class='col-md-offset-1 col-md-3 control-label'>Session</label>
			<div class='col-md-6'>
				<input type='text' class='form-control' id='session' maxlength="15" >
			</div>
		</div>	
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="button" class="btn btn-success" id="classModalSubmit" onclick="submitNewClass()">Save changes</button>
</div>
