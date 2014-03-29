<!DOCTYPE HTML>

<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	require_once("files/standard/standard_includes.php");
	require_once("facebook/facebook.php");
			
	$friends = $carbon->getFriendsList();
	
?>
<html>
	<head>
		<title> Carbon Calculator Social</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script src="files/social/social.js"></script>

	</head>
	
	<body onload="initialise()">
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container" style="padding-top: 50px;">
		
			<div class="row">
			
				<div class="col-md-8">
					
					<div class='row'  id="groups_container">
						
						<h1> My Groups </h1>
						<div>
							<div style="text-align: center; padding-top: 25px; padding-bottom: 25px;"><img src='files/images/loading.gif'></div>
						</div>
					</div>
					<div class='row'>
						
						<h1> Friends Latest Activity </h1>
						<div class='well'>
							<div id="activity_container"></div>
							<div style="text-align: center; padding-top: 100px;" id="loading_indicator"><img src='files/images/loading.gif'></div>
						</div>
					</div>		
				</div>
				
				<div class="col-md-3 col-md-offset-1">
				
					<div class="row" style="max-height: 50%; overflow: hidden;">
						<div class="col-xs-12" style="padding-left: 0px; padding-right: 0px;" id="friends_list"> 
						</div>
					</div>
					<div class="row" style="max-height: 40%; overflow: scroll;">
						<div class="col-xs-12" id="outstanding_requests_container"> 
						</div>
					</div>
					<div class="row" style="padding-top: 25px;">
						<button class="btn btn-success btn-lg" data-toggle="modal" onclick="openFindFriendModal()" style="width: 100%;">
							Find New Friends
						</button>
						<button class="btn btn-success btn-lg" data-toggle="modal" onclick="openCreateGroupModal()" style="width: 100%; margin-top: 10px;">
							Create Group
						</button>
					</div>
				</div>
			
			</div>


		</div>
		
		<div class="modal fade" id="friendsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content" style="padding: 15px;">
		    		<div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title">Find Friends</h4>
					 </div>
					<div class="modal-body" id="findFriendsModalContent">
						<div style="text-align: center; padding-top: 100px; padding-bottom: 100px;"><img src='files/images/loading.gif' id='loading-indicator'></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
					</div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	


		<!-- ACTIVITY MODAL -->
			<div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content" id="activityModalContent">
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->	
			
		<!-- GROUP MODAL -->
		<div class="modal fade" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content" id="addGroupModalContent">
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
	</body>