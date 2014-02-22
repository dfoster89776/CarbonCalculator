<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	
	$class = $carbon->getClassDetails($_POST['classcode']);
	
	$data = $carbon->getClassStudentDetails($_POST['classcode']);
	
	echo ("<h1>".$class['class_data']['module_number']."</h1>");

	if($data != null){
	
		echo("<div class='table-responsive'>
				  <table class='table table-hover'>
					<tr>
						<th>Student Name</th>
						<th>Registration Date</th>
						<th>Last Login</th>
						<th> </th>
						<th> </th>
					</tr>");
					
		foreach ($data as &$student){
			
			echo("<tr>");
			echo("<td>".$student['firstname']." ".$student['surname']."</td>");
			echo("<td>".$student['join_date']."</td>");
			echo("<td>".$student['last_login']."</td>");
			echo("<td><button type='button' class='btn btn-primary' onclick='openStudentModal(\"".$student['username']."\")'>View Activity</button></td>");
			echo("<td><a href='profile.php?profile=".$student['username']."'><button type='button' class='btn btn-primary' >View Profile</button></a></td>");
			echo("</tr>");
			
		}
					
					
		echo(" </table></div>");
		
	}
	else{
		echo("<div class='alert alert-warning'>There are no students enrolled in this module.</div>");
	}
	
?>