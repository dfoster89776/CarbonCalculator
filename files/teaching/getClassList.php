<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	require_once("../standard/standard_includes.php");
	$classes  = $carbon->getClassesTaught();
	
	foreach($classes as &$class){
								
		echo("<a class='list-group-item' id='a_".$class['class_number']."' onclick='openClass(\"".$class['class_number']."\")'>");
		echo("<button type='button' class='close pull-right' aria-hidden='true' onclick='deleteClass(\"".$class['class_number']."\")'>&times;</button>");
		echo("<h4 class='list-group-item-heading'>".$class['module_number']."</h4>");
		echo("<p class='list-group-item-text'>Class Number: ".$class['class_number']."</p>");
		echo("<p class='list-group-item-text'>Session: ".$class['session']."</p>");
		echo("<p class='list-group-item-text'>Students: ".$class['no_students']."</p>");
		echo("</a>");
	}
?>