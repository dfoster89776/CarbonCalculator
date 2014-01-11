<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");	
	
	$carbon = new Carbon();

	$data = $carbon->getSubscribedClasses();
	
	if ($data == null){
		echo("<div class='alert alert-warning alert-dismissable'><strong>Warning!</strong> You have not registered with any classes.</div>");
	}else{
	
		echo("<ul class='list-group'>");
		
		foreach ($data as &$class) {
			$classNo = $class['class_number'];
			echo("<li class='list-group-item'>");
			echo("<button type='button' class='close pull-right' aria-hidden='true' onclick='removeClass(\"".$classNo."\")'>&times;</button>");
			echo ("<h4 class='list-group-item-heading'>".$class['module_number']."</h4>");
			echo ("<p class='list-group-item-text'>Session: ".$class['session']."</h4>");
			echo ("<p class='list-group-item-text'>Coordinator: ".$class['coordinator']."</h4>");
			
			echo("</li>");
		}
		
		echo ("</ul>");
		
		
	}

?>