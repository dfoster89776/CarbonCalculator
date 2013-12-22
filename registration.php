<!DOCTYPE html>

<?php
	session_start();
	require_once("files/carbon.php");
	$carbon = new Carbon();
	require_once("files/standard/standard_includes.php");
	
?>

<html>
	<head>
		<title> Carbon Calculator Registration</title>
		<?php 	require_once("files/standard/standard_includes.php"); ?>
		<script src="files/registration/register.js"></script>
	</head>
	
	<body>
		
	<nav class='navbar navbar-default navbar-inverse navbar-fixed-top' role='navigation'>
		  <!-- Brand and toggle get grouped for better mobile display -->
		  <div class='navbar-header'>
		    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
		      <span class='sr-only'>Toggle navigation</span>
		      <span class='icon-bar'></span>
		      <span class='icon-bar'></span>
		      <span class='icon-bar'></span>
		    </button>
		    <a class='navbar-brand' href='#'>Carbon Calculator</a>
		  </div>
		
		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class='collapse navbar-collapse navbar-ex1-collapse '>
		    <ul class='nav navbar-nav'>
		      
		    </ul>
		    
		    <?php
		    	if(isset($_SESSION['username'])){
			    	
			    	echo ("
			    	
			    	
			    			<ul class='nav navbar-nav navbar-right' >
							<li class='dropdown'>
					    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
					      Logout					      
						  <b class='caret'></b>
					    </a>
					    <ul class='dropdown-menu navbar-right'>
					      <li><a href='files/secure/logout.php'>Logout</a></li>
					    </ul>
					  </li>
						</ul>

			    	
			    		");
			    	
		    	} ?>
					    
		  </div><!-- /.navbar-collapse -->
		</nav>
		
		<div class="container" id="container">
						
			<?php require_once("files/registration/register.php");	?>
					
		</div>

	
	</body>
</html>