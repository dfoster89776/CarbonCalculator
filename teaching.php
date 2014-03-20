<!DOCTYPE html>
<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	require_once("files/standard/standard_includes.php");
	$classes  = $carbon->getClassesTaught();
?>

<html>
	<head>
		<title> Carbon Calculator Teaching </title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script src="files/teaching/teaching.js"></script>
	</head>
	
	<body onload="initialise()">
	
		<?php require_once("files/navigation/secure_nav.php"); ?>
	
		<div class="container" style="padding-top: 30px;">
  
			<div class="row">
			
				<div class="col-md-3" id="classes_container">
					
					<div>
						<button type="button" class="btn btn-success btn-block btn-lg" onclick="openAddClassModal()">Add Class</button>
					</div>
					<br/>
					
					<div class="list-group" id="classListContent">

					</div>					
				</div>
				
				<div class="col-md-8 col-md-offset-1" id="classes_detail_container">
				
				</div>
		</div>
		
<!-- Student Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="studentModalContent">
	    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Add ClassModal -->
<div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="addClassModalContent">
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Add ClassModal -->
<div class="modal fade" id="deleteClassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="deleteClassModalContent">
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	</body>