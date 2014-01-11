var current;

function displayOverview(){
	
	if (current != "overview"){
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
		    document.getElementById("nav_overview").className = "active";
			document.getElementById("nav_personal").className = "";
			document.getElementById("nav_connected").className = "";
			document.getElementById("nav_class").className = "";
			document.getElementById("container").innerHTML = xmlhttp.responseText;
			current = "overview";
		    }
		  }
		xmlhttp.open("GET","files/account/overview.php",true);
		xmlhttp.send();
		document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	}
}

function displayPersonal(){
	
	if (current != "personal"){
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
		    document.getElementById("nav_overview").className = "";
			document.getElementById("nav_personal").className = "active";
			document.getElementById("nav_connected").className = "";
			document.getElementById("nav_class").className = "";
			document.getElementById("container").innerHTML = xmlhttp.responseText;
			current = "personal";
		    }
		  }
		xmlhttp.open("GET","files/account/personal_details.php",true);
		xmlhttp.send();
		document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	}
}

function displayConnected(){
	
	if (current != "connected"){
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
		    document.getElementById("nav_overview").className = "";
			document.getElementById("nav_personal").className = "";
			document.getElementById("nav_connected").className = "active";
			document.getElementById("nav_class").className = "";
			document.getElementById("container").innerHTML = xmlhttp.responseText;
			current = "connected";
		    }
		  }
		xmlhttp.open("GET","files/account/connected_accounts.php",true);
		xmlhttp.send();
		
		document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	}

}


function displayClass(){
	
	if (current != "class"){
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
		    document.getElementById("nav_overview").className = "";
			document.getElementById("nav_personal").className = "";
			document.getElementById("nav_connected").className = "";
			document.getElementById("nav_class").className = "active";
			document.getElementById("container").innerHTML = xmlhttp.responseText;
			current = "class";
		    }
		  }
		xmlhttp.open("GET","files/account/class.php",true);
		xmlhttp.send();
		
		document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	}
}

function updateSubscribedClasses(){
		
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
			document.getElementById("subscribedClasses").innerHTML = xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","files/account/subscribedClasses.php",true);
		xmlhttp.send();
}


function removeFacebook(){
	
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
		document.getElementById("container").innerHTML = xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","files/account/remove_facebook.php",true);
	xmlhttp.send();
	
	document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
}

function checkClassValidity(){
	
	var param = "classcode=" + document.getElementById("inputClassCode").value;
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
			var obj = JSON.parse(xmlhttp.responseText);
			if (obj['valid'] == true){
				document.getElementById("classAlert").style.visibility = "hidden";
				document.getElementById("module_code").innerHTML = obj['class_data']['module_number'];
				document.getElementById("module_teacher").innerHTML = obj['class_data']['coordinator_name'];
				document.getElementById("module_session").innerHTML = obj['class_data']['session'];
			}else{
				document.getElementById("classAlert").style.visibility = "visible";
				document.getElementById("module_code").innerHTML = " - ";
				document.getElementById("module_teacher").innerHTML = " - ";
				document.getElementById("module_session").innerHTML = " - ";
			}
			
	    }
	  }
	xmlhttp.open("POST","files/account/checkClassValidity.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);	
}

function joinClass(){
	
	var param = "classcode=" + document.getElementById("inputClassCode").value;
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
	    	obj = JSON.parse(xmlhttp.responseText);
			document.getElementById("class_modal_body").innerHTML = obj['html'];
			document.getElementById("class_modal_submit").style.display = "None";
			document.getElementById("class_modal_cancel").style.visibility = "visible";
			updateSubscribedClasses();
	    }
	  }
	xmlhttp.open("POST","files/account/addClass.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	document.getElementById("class_modal_body").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	document.getElementById("class_modal_cancel").style.visibility = "hidden";
	document.getElementById("class_modal_submit").disabled = true;
	document.getElementById("class_modal_submit").innerHTML = "Processing";	
}

function resetClassModal(){
	
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
	    document.getElementById("classModal").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","files/account/classModal.php",true);
	xmlhttp.send();
	
}

function removeClass(classNumber){
	
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
	    	obj = JSON.parse(xmlhttp.responseText);
	    		    	
	    	if(obj['success'] == true){
	    		displayClass();
	    		document.getElementById('alerts').innerHTML = "<div class='alert alert-success alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> <strong>Removed!</strong> The class has been successfully removed.</div>"
	    	}
	    	else{
		    	document.getElementById('alerts').innerHTML = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> <strong>Error!</strong> The class could not be removed. Please try again later.</div>"
	    	}
	    	updateSubscribedClasses();
	    }
	  }
	xmlhttp.open("POST","files/account/removeClass.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}