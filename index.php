<!DOCTYPE html>
<?php
	session_start();
	require_once("files/secure/checkLoginState.php");
?>

<html>
	<head>
		<title> Carbon Calculator</title>
		<?php require_once("files/standard/standard_includes.php"); ?>
		<script src="files/index/index.js"></script>
	</head>
	
	<body style="margin-bottom: 0px;">
	
		<!-- NAVIGATION BAR INCLUDE -->
		<?php require_once("files/navigation/unsecure_nav.php"); ?>
	
		
		<!--HEADING CONTAINER -->
		<div class="index_container" >
			<h1 class="index_header" id="index_heading">St Andrews <br/> Carbon Calculator</h1>
		</div>
		
		
		<!--FEATURE OPTION BAR-->
		<div class="row hidden-xs front" style="margin: 0px;">
					<div class="col-sm-2 index_section_tab"></div>
			<div class="col-sm-2 index_section_tab index_section_tab_hover border-white-right"  onclick="openSect(1)">
				<h3> Keep track of both journeys and energy use </h3>
			</div>
			<div class="col-sm-2 index_section_tab index_section_tab_hover border-white-right"  onclick="openSect(2)">
				<h3> Monitor carbon production over time </h3>
			</div>
			<div class="col-sm-2 index_section_tab index_section_tab_hover border-white-right"  onclick="openSect(3)">
				<h3> Plan changes and reduce your footprint </h3>
			</div>
			<div class="col-sm-2 index_section_tab index_section_tab_hover"  onclick="openSect(4)">
				<h3>Share and compare with your friends </h3>
			</div>
			<div class="col-sm-2 index_section_tab"></div>	
		</div>
		
		
		<!--FEATURE INFO CONTAINERS-->
		<div class="index_cont front" id="sect_1">
			<div class=" row" style="margin: 0px;">
				<div class="col-sm-4 col-sm-offset-2">
					<h2 class="green">Record Carbon Activities</h2>
					<p class="index-text"> The Carbon Calculator allows you to record the activities in your life that contribute towards your carbon footprint. Input your latest home meter readings, or the journeys you make, and we will automatically calculate their footprint. </p>
				</div>
				<div class="col-sm-4 hidden-xs" style="text-align: center;">
					<image src="files/images/chart.png" class="image">
				</div>
			</div>
		</div>
		
		<div class="index_cont front visible-xs" id="sect_2">
			<div class="row" style="margin: 0px;">
				<div class="col-sm-4 col-sm-offset-2">
					<h2 class="green">Monitor your long term carbon footprint</h2>
					<p class="index-text"> The Carbon Calculator allows you to view your entire carbon history from the day you join. Visualise the make up of your carbon footprint, and track the changes over time as you work to reduce your footprint.</p>
				</div>
				<div class="col-sm-4 hidden-xs" style="text-align: center;">
					<image src="files/images/chart.png" class="image">
				</div>
			</div>
		</div>
		
		<div class="index_cont front visible-xs" id="sect_3">
			<div class="row" style="margin: 0px;">
				<div class="col-sm-4 col-sm-offset-2">
					<h2 class="green">Plan to reduce your footprint</h2>
				</div>
				<div class="col-sm-4 hidden-xs" style="text-align: center;">
					<image src="files/images/chart.png" class="image">
				</div>
			</div>
		</div>
		
		<div class="index_cont front visible-xs" id="sect_4">
			<div class="row" style="margin: 0px;">
				<div class="col-sm-4 col-sm-offset-2">
					<h2 class="green">Share and Compare with your friends.</h2>
					<p class="index-text"> The Carbon Calculator connects with Facebook, to allow you to view your friends profiles and carbon statistics, and compare against each other as you try to better each others footprint.</p>
				</div>
				<div class="col-sm-4 hidden-xs">
					<image src="files/images/social.jpg" class="image">
				</div>
			</div>
		</div>
		
		<!--REGISTRATION CONTAINER-->
		<div class="green_container front">
			<div class="container white">
				<div class="row" style="margin: 0px;">
					<div class="col-sm-offset-1 col-sm-4">
					<h1>Register Now </h1>
						<p style="font-size: 170%"> Register now to start tracking your carbon output, monitor your carbon history and plan for the future. Registering is easy and free.</p>
					</div>
					<div class="col-sm-6 col-sm-offset-1">
						<div class='form-horizontal' role='form'>
							<div class='form-group' id='inputUsernameDiv'>
								<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Username</label>
								<div class='col-md-6'>
									<input type='email' class='form-control' id='inputUsername' placeholder='Username' onkeyup='checkUsername()'  onchange='checkUsername()'>
								</div>
							</div>
							<div class='form-group' id='inputEmailDiv'>
								<label for='inputEmail1' class='col-md-3 col-md-offset-1 control-label'>Email</label>
								<div class='col-md-6'>
									<input type='email' class='form-control' id='inputEmail1' placeholder='Email' onkeyup='validateEmail()' onchange='validateEmail()'>
								</div>
							</div>
							<div class='form-group' id='inputPasswordDiv'>
								<label for='inputPassword1' class='col-md-3 col-md-offset-1 control-label'>Password</label>
								<div class='col-md-6'>
									<input type='password' class='form-control' id='inputPassword1' placeholder='Password' onkeyup='checkPasswordStrength()' onchange='checkPasswordStrength()'>
								</div>
							</div>
							<div class='form-group' id='inputPassword2Div'>
								<label for='inputPassword2' class='col-md-3 col-md-offset-1 control-label'>Re-type Password</label>
								<div class='col-md-6'>
									<input type='password' class='form-control' id='inputPassword2' placeholder='Re-type Password' onkeyup='checkPasswordMatch()' onchange='checkPasswordMatch()'>
								</div>
							</div>
							<div class='form-group' id='inputPassword2Div'>
								<div class='col-md-6 col-md-offset-4'>
									<button class='btn-primary  btn btn-block' style='min-width: 100%' onclick='submitLoginDetails()'>Continue</button>
								</div>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
		
		<!--PAGE FOOTER -->
		<div class="dark_green_container front">
			<p>Designed by David Foster, University of St. Andrews</p>
			<p>This website is the deliverable code implementation of a Senior's Honours Project, Module CS3099. </p>
			<p> The image at the top of this page, was taken from <a href="http://www.st-andrews.ac.uk">www.st-andrews.ac.uk</a></p>
		</div>
	
	</body>