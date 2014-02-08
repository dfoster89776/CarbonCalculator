<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	
	$module_number = $_POST['module_number'];
	$session = $_POST['session'];
			
	$data = $carbon->registerNewClass($_POST['module_number'], $_POST['session']);	
		
	if ($data){
		echo("<div class='alert alert-success'><strong>Success!</strong> You have created the class. Students can use the unqiue class number below to join. </div>");
		echo("<div class='form-horizontal' role='form'>");
		echo("<div class='form-group'>
				<label for='classNumber' class='col-md-offset-1 col-md-3 control-label'>Class Number</label>
				<div class='col-md-6'>
					<p class='form-control-static' id='classNumber'><strong>".$data['class_number']."</strong></p>
				</div>
			</div>");
		echo("<div class='form-group'>
				<label for='moduleNumber' class='col-md-offset-1 col-md-3 control-label'>Module Number</label>
				<div class='col-md-6'>
					<p class='form-control-static' id='moduleNumber'>".$data['module_number']."</p>
				</div>
			</div>");
		echo("<div class='form-group'>
				<label for='session' class='col-md-offset-1 col-md-3 control-label'>Session</label>
				<div class='col-md-6'>
					<p class='form-control-static' id='session'>".$data['session']."</p>
				</div>
			</div>");
		echo("</div");
	}else{
		echo("<div class='alert alert-success'><strong>Error!</strong>An error occurred, please try again.</div>");
	}
?>	