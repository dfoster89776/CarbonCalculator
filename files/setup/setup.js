var carbon_values = new Array();
carbon_values[1] = 0.16192;
carbon_values[2] = 0.2049;
carbon_values[3] = 0.29678;
carbon_values[4] = 0.14048;
carbon_values[5] = 0.17475;
carbon_values[6] = 0.22941;
var car_type = new Array();
car_type[0] = "none";
car_type[1] = "petrolSmall";
car_type[2] = "petrolMedium";
car_type[3] = "petrolLarge";
car_type[4] = "dieselSmall";
car_type[5] = "dieselMedium";
car_type[6] = "dieselLarge";
car_type[7] = "custom";

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


function changeCarType(){

	var index = document.getElementById("car_type").selectedIndex;
	if (index > 0 && index < 7){
		document.getElementById("car_carbon").value = carbon_values[index];
		document.getElementById("car_carbon").readOnly = true;
	}
	else if(index == 0){
		document.getElementById("car_carbon").value = "";
		document.getElementById("car_carbon").readOnly = true;
	}
	else if(index == 7){
		document.getElementById("car_carbon").value = "";
		document.getElementById("car_carbon").readOnly = false;
	}
		
}

function setCustom(){
	document.getElementById("car_type").selectedIndex = 7;
}

function updateTransport(){
		
	var index = document.getElementById("car_type").selectedIndex;
	type = car_type[index];
	var car_co2 = document.getElementById("car_carbon").value;

	param = "car_co2=" + car_co2 + "&cartype=" + type;
		
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
