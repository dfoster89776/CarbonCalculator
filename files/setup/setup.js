function loadTransport(){
	
	document.getElementById("nav_energy").className = "";
	document.getElementById("nav_lifestyle").className = "";
	document.getElementById("nav_transport").className = "active";
	
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
	    document.getElementById("container").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","files/setup/transport.php",true);
	xmlhttp.send();
	document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	
}


function loadEnergy(){
	
	document.getElementById("nav_energy").className = "active";
	document.getElementById("nav_lifestyle").className = "";
	document.getElementById("nav_transport").className = "";
	
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
	    document.getElementById("container").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","files/setup/energy.php",true);
	xmlhttp.send();
	document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	
}


function loadLifestyle(){
	
	document.getElementById("nav_energy").className = "";
	document.getElementById("nav_lifestyle").className = "active";
	document.getElementById("nav_transport").className = "";
	
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
	    document.getElementById("container").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","files/setup/lifestyle.php",true);
	xmlhttp.send();
	document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	
}


function updateTransport(){
	
	
}
