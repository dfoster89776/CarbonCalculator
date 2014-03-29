<!DOCTYPE HTML>

<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	require_once("files/standard/standard_includes.php");
	$_SESSION['group_number'] = $_GET['groupNo'];	
	
?>
<html>
	<head>
		<title> Carbon Calculator Group</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script type='text/javascript' src='https://www.google.com/jsapi'></script>
		<script src="files/groups/groups.js"></script>

	</head>
	
	<body onload="initialise()">
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container" style="padding-top: 30px;">
		
			<div class="row">
			
				<div class="col-md-8">
					
					<div class="page-header">
					  <h1><?php echo($carbon->getGroupName($_GET['groupNo'])) ?></h1>
					</div>			
					
					<h2> Group Statistics </h2>
					<div class='well' id="group_statistics"></div>
					
					<h2> Group Leaderboard </h2>
					<div id="group_leaderboard"></div>
					
				</div>
				
				<div class="col-md-3 col-md-offset-1">
					<div class="row" style="padding-top: 15px;">
						<button class="btn btn-success btn-lg" data-toggle="modal" onclick="openAddFriendsModal(' <?php echo $_GET['groupNo'] ?>')" style="width: 100%;">
							Add Friends to Group
						</button>
						<button class="btn btn-success btn-lg" data-toggle="modal" onclick="openLeaveGroupModel()" style="width: 100%; margin-top: 10px;">
							Leave Group 
						</button>
						<h2 style='margin-top: 30px;'>Group Members </h2>
						<div class='well' style='max-height: 500px; overflow: scroll;' id='group_friends'>
							
						</div>
					</div>
				</div>
			
			</div>


		</div>
			
		<!-- LEAVE GROUP MODAL -->
		<div class="modal fade" id="leaveGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content" id="leaveGroupModalContent">
		    	
		    	<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    <h4 class="modal-title" id="myModalLabel">Leave Group</h4>
				</div>
				<div class="modal-body" id="newGroupBody">
					<h3>Are you sure you want to leave this group?</h3>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="leaveGroup(' <?php echo $_GET['groupNo'] ?>')">Leave Group</button>
				</div>
		    
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
		
		<!-- ADD FRIENDS TO GROUP MODAL -->
		<div class="modal fade" id="addFriendsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content" id="addFriendsModalContent">
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
	</body>