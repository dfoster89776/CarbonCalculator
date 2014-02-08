<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/secure/check_login.php");
	require_once("files/standard/standard_includes.php");
	require_once("facebook/facebook.php");
			
	$friends = $carbon->getFriendsList();
	
?>
<!DOCTYPE html>

<html>
	<head>
		<title> Carbon Calculator Social</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script src="files/social/social.js"></script>

	</head>
	
	<body onload="initialise()">
	
		<?php require_once("files/navigation/secure_nav.php");?>
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-md-8" id="activity_container">
					
					<h1> Friends </h1>
									
					<div class="row">
					
						<?php
						
							if ($friends != null){
								foreach ($friends as &$friend){
																	
									echo ("<div class='col-sm-6 col-md-4'>");
									echo ("<div class='thumbnail'>");
									echo ("<img src='".$carbon->getOtherFacebookUserImageFromUserId($friend['userid'])."' alt='user image' width='80%' style='margin-top: 20px;'>");
									echo("<div class='caption'>");
									echo("<h3>".$friend['firstname']." ".$friend['surname']."</h3>");
									echo("<p> </p>");
									echo("<p><a href='#' class='btn btn-primary' role='button'>Profile</a> <a href='#' class='btn btn-default' role='button'>Compare</a></p>");
									echo("</div>");
									echo("</div>");
									echo("</div>");
								}
							}
						?>
					  
					</div>
								
				</div>
				
				<div class="col-md-3 col-md-offset-1">
				
					<div class="row" style="max-height: 40%; overflow: scroll;">
						<div class="col-xs-12" id="outstanding_requests_container"> 
						</div>
					</div>
					<div class="row" style="max-height: 40%; overflow: scroll;">
						<div class="col-xs-12" id="find_friends_container"> 
						</div>
					</div>
					
				</div>
			
			</div>


		</div>

	</body>