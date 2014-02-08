var current = null;

function initialise(){
	loadClassList();
}

function loadClassList(){
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	
	    	document.getElementById("classListContent").innerHTML = xmlhttp.responseText;
	    	if (current != null){
	    		alert(current);
	    		id = "a_" + current;
				document.getElementById(id).className = "list-group-item active";
	    	}   
	    		    	
	    }
	  }
	xmlhttp.open("POST","files/teaching/getClassList.php",true);
	xmlhttp.send();

	
}

function openClass(classNumber){
		
	var param = "classcode=" + classNumber;
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	
	    	document.getElementById("classes_detail_container").innerHTML = xmlhttp.responseText;
	    	
	    	if (current != null){
				id = "a_" + current;
				document.getElementById(id).className = "list-group-item";
			}
		
			id = "a_" + classNumber;
			document.getElementById(id).className = "list-group-item active";
			current = classNumber;
	    	
	    }
	  }
	xmlhttp.open("POST","files/teaching/classDetails.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);	
	document.getElementById("classes_detail_container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
}

function openAddClassModal(){

	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	
	    	document.getElementById("addClassModalContent").innerHTML = xmlhttp.responseText;
			$('#addClassModal').modal('show');
	    		    	
	    }
	  }
	xmlhttp.open("POST","files/teaching/addClassModal.php",true);
	xmlhttp.send();
	
}

function openStudentModal(studentUsername){
	
	var param = "username=" + studentUsername;
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	
	    	document.getElementById("studentModalContent").innerHTML = xmlhttp.responseText;
			$('#studentModal').modal('show');
	    		    	
	    }
	  }
	xmlhttp.open("POST","files/teaching/studentModal.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}

function submitNewClass(){
	
	moduleNumber = document.getElementById("moduleNumber").value;
	session = document.getElementById("session").value;
	
	var param = "module_number=" + moduleNumber + "&session=" + session;
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	document.getElementById("classModalSubmit").style.display = "none";
	    	document.getElementById("addClassModalBody").innerHTML = xmlhttp.responseText;
	    	loadClassList();
	    }
	  }
	xmlhttp.open("POST","files/teaching/registerNewClass.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}

function deleteClass(class_number){
		
	var param = "class_number=" + class_number;
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	document.getElementById("deleteClassModalContent").innerHTML = xmlhttp.responseText;
	    	$('#deleteClassModal').modal('show');
	    }
	  }
	xmlhttp.open("POST","files/teaching/deleteClassModal.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);

	
}

function confirmDelete(class_number){
		
	var param = "class_number=" + class_number;
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	document.getElementById("deleteClassModalContent").innerHTML = xmlhttp.responseText;
	    	current = null;
	    	loadClassList();
	    	document.getElementById("classes_detail_container").innerHTML = "";
	    }
	  }
	xmlhttp.open("POST","files/teaching/confirmDeleteClass.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}