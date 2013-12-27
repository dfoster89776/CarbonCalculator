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
		
	var car_co2 = document.getElementById("kgeCO2").value;
	
	if (car_co2 != ""){
	
		param = "car_co2=" + car_co2;
		
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
		xmlhttp.open("POST","files/setup/updateTransport.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(param);
		document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	}else{
		alert("No changes to be saved");
	}
	
}

function updateEnergy(){
	
	var data = new Object();
	
	data.residents = document.getElementById('residents').value;
	data.elec_factor = document.getElementById('elec_factor').value;
	data.gas_factor = document.getElementById('gas_factor').value;
	data.walls = document.getElementById('walls').value;
	data.roof = document.getElementById('roof').value;
	data.windows_doors = document.getElementById('windows_doors').value;
	data.draughts = document.getElementById('draughts').value;
	data.hot_water_tank = document.getElementById('hot_water_tank').value;
	data.boiler = document.getElementById('boiler').value;
	data.thermostat = document.getElementById('thermostat').value;
	data.hours = document.getElementById('hours').value;
	
	var json = "json=" + JSON.stringify(data);
	
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
	xmlhttp.open("POST","files/setup/updateEnergy.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(json);
	document.getElementById("container").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";

}
