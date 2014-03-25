var formValidity = true;

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

function loadContent(){
	
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
	xmlhttp.open("GET","files/registration/register.php",true);
	xmlhttp.send();
	
}

function submitLoginDetails(){
		
	username = document.getElementById('inputUsername').value;
	password = document.getElementById('inputPassword1').value;
	password2 = document.getElementById('inputPassword2').value;
	email = document.getElementById('inputEmail1').value;
	
	param = "username="+ username + "&password=" + password + "&email=" + email;
		
	if (formValidity){
	
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
		    	location.reload();
		    }
		  }
		xmlhttp.open("POST","files/registration/register_user_details.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(param);
		
	}
}

function submitPersonnalDetails(){
			
	firstname = document.getElementById('inputFirstname').value;
	surname = document.getElementById('inputSurname').value;
	
	param = "firstname="+ firstname + "&surname=" + surname;
		
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
	    location.reload();
	    }
	  }
	xmlhttp.open("POST","files/registration/register_personnel_details.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
}

function submitSocialNetwork(){
	
	
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
	    location.reload();
	    }
	  }
	xmlhttp.open("GET","files/registration/register_social.php",true);
	xmlhttp.send();

}

function submitSetupInfo(){
	
	
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
	    location.reload();
	    }
	  }
	xmlhttp.open("GET","files/registration/register_setup_info.php",true);
	xmlhttp.send();

}

function submitSetupOne(){

	var index = document.getElementById("car_type").selectedIndex;
	type = car_type[index];

	carco2 = document.getElementById('car_carbon').value;
	
	param = "carco2="+ carco2 + "&cartype=" + type;

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
		 location.reload();
	    }
	  }
	xmlhttp.open("POST","files/registration/register_setup_one.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
}

function submitSetupTwo(){

	
	residents = document.getElementById('residents').value;
	electricity = document.getElementById('electricity_meter').value;
	gas = document.getElementById('gas_meter').value;
	walls = document.getElementById('walls').value;
	roof = document.getElementById('roof').value;
	windows_doors = document.getElementById('windows_doors').value;
	draughts = document.getElementById('draughts').value;
	hot_water_tank = document.getElementById('hot_water_tank').value;
	boiler = document.getElementById('boiler').value;
	thermostat = document.getElementById('thermostat').value;
	hours = document.getElementById('hours').value;
	
	param = "residents="+ residents + "&electricity=" + electricity + "&gas=" + gas + "&walls=" + walls + "&roof=" + roof + "&windows_doors=" + windows_doors + "&draughts=" + draughts + "&hot_water=" + hot_water_tank  + "&boiler=" + boiler + "&thermostat=" + thermostat  + "&hours=" + hours;

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
		 location.reload();
	    }
	  }
	xmlhttp.open("POST","files/registration/register_setup_two.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}

function submitSetupThree(){

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
		location.reload();
	    }
	  }
	xmlhttp.open("POST","files/registration/register_setup_three.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
}

function checkUsername(){
	
	username = document.getElementById("inputUsername").value;
	param = "username="+ username;
	
	if (username == ""){
		document.getElementById("inputUsernameDiv").className="form-group has-error";
	}
	else{
	
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
		    	if(xmlhttp.responseText == "true"){
			    	document.getElementById("inputUsernameDiv").className="form-group has-error";
		    	}else{
			    	document.getElementById("inputUsernameDiv").className="form-group has-success";
		    	}

		    			    	
		    }
		  }
		xmlhttp.open("POST","files/registration/check_username.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(param);
	}
}

function validateEmail() 
{
	email = document.getElementById("inputEmail1").value;
    var re = /\S+@\S+\.\S+/;
    
    validEmail = re.test(email)
    
    if(!validEmail){
		document.getElementById("inputEmailDiv").className="form-group has-error";
	}else{
		document.getElementById("inputEmailDiv").className="form-group has-success";
	}

    
    return validEmail;
}

function checkPasswordStrength(){
		
	password = document.getElementById("inputPassword1").value;
	
	var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
	var validPassword = re.test(password);
	
	if(!validPassword){
		document.getElementById("inputPasswordDiv").className="form-group has-error";
	}else{
		document.getElementById("inputPasswordDiv").className="form-group has-success";
	}
	
}

function checkPasswordMatch(){
	
	
	password1 = document.getElementById("inputPassword1");
	password2 = document.getElementById("inputPassword2");
	
	if(password1.value != password2.value){
		document.getElementById("inputPassword2Div").className="form-group has-error";
	}
	else if(password1.value == ""){
		document.getElementById("inputPassword2Div").className="form-group has-error";
	}else{
		document.getElementById("inputPassword2Div").className="form-group has-success";
	}

	
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