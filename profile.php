<!DOCTYPE HTML>

<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	require_once("files/standard/standard_includes.php");
	require_once("facebook/facebook.php");
	$profile = $_GET['profile'];
	$_SESSION['profile'] = $profile;	
?>

<html>
	<head>
		<title> Profile </title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" src="files/dashboard/dashboard.js"></script>
		<script src="files/profile/profile.js"></script>
	</head>
	
	<body onload="initialise()" style="padding-top: 30px;">
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<?php 
		if ($carbon->validateViewProfilePermission($profile)){
		
		
		
		?>
			<div class="container">
		
				<div id="profile_header" class="profileHeader">
					<div class="row">
						<div class="col-sm-3">
							<?php echo("<img src='".$carbon->getOtherFacebookUserImageFromUserId($carbon->getFacebookId($profile))."' width='80%' class='img-thumbnail'>"); ?>
						</div>
						<div class="col-sm-9">
							<h1> <?php echo $carbon->getFriendsName($profile); ?> </h1>
						</div>
						<div class="col-sm-9" style="position: relative; top: 100px;">
							<ul class="nav nav-pills">
							  <li id="overviewPill" class="active" onclick="loadProfileDashboard()"><a href="#">Overview</a></li>
							  <li id="statisticsPill"><a>History</a></li>
							  <li id="activityPill"><a onclick="loadActivityTab()">Activity</a></li>
							   <li id="comparisonPill"><a >Compare Carbon Output</a></li>
							</ul>
						</div>
					</div>
				</div>
				<hr/>
				<div id="content" style="margin-top: 60px;">
				</div>
			
			</div>
			
			<!-- ACTIVITY MODAL -->
			<div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content" id="activityModalContent">
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->	


			
		
		<?php
		}else{
		?>
		
			<div class="container">
				<div class="alert alert-danger"> You are not friends with this person, so cannot view their profile </div>	
			</div>
			
		
		<?php
		}
		?>	

	</body>