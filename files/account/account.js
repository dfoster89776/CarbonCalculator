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
			document.getElementById("container").innerHTML = xmlhttp.responseText;
			current = "connected";
		    }
		  }
		xmlhttp.open("GET","files/account/connected_accounts.php",true);
		xmlhttp.send();
		
		document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	}

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