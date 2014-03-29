<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();

	$data = $carbon->getUsersGroups();
	
	echo("<h1> My Groups </h1>");
	
	echo("<div class='row'>");
		
	foreach($data as $group){
		
		echo("<a class='col-sm-4' href='group.php?groupNo=".$group['groupNo']."'><div class='well'> <h2>".$group['groupName']."</h2><h4>Members: ".$group['members']."</h4></div></a>");
		
	}

	echo("</div>");

?>