
var formValidity = true;

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

	carco2 = document.getElementById('kgeCO2').value;
	
	param = "carco2="+ carco2;

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
	elec_factor = document.getElementById('elec_factor').value;
	gas_factor = document.getElementById('gas_factor').value;
	walls = document.getElementById('walls').value;
	roof = document.getElementById('roof').value;
	windows_doors = document.getElementById('windows_doors').value;
	draughts = document.getElementById('draughts').value;
	hot_water_tank = document.getElementById('hot_water_tank').value;
	boiler = document.getElementById('boiler').value;
	thermostat = document.getElementById('thermostat').value;
	hours = document.getElementById('hours').value;
	
	param = "residents="+ residents + "&gas_factor=" + gas_factor + "&elec_factor=" + elec_factor + "&walls=" + walls + "&roof=" + roof + "&windows_doors=" + windows_doors + "&draughts=" + draughts + "&hot_water=" + hot_water_tank  + "&boiler=" + boiler + "&thermostat=" + thermostat  + "&hours=" + hours;

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

function verifyUserDetails(){
	
	valid = true;
	
	var alerts = document.getElementById("alerts");
	
	alerts.innerHTML = "";

	
	password1 = document.getElementById("inputPassword1");
	password2 = document.getElementById("inputPassword2");
	username = document.getElementById("inputUsername");
	email = document.getElementById("inputEmail1");
	
	username = document.getElementById("inputUsername").value;
	param = "username="+ username;
	
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
		    	
		    	if (inputUsername.value == ""){
					valid = false;
					alerts.innerHTML = "<div class='alert alert-danger'>No username entered.</div>";
				}
				else if(xmlhttp.responseText == "true"){
					valid = false;
					alerts.innerHTML = "<div class='alert alert-danger'>Username already used.</div>";
				}
				
				if (inputEmail1.value == ""){
					valid = false;
					alerts.innerHTML = alerts.innerHTML + "<div class='alert alert-danger'>No email entered.</div>";
				}
				
				if (password1.value == ""){
					valid = false;
					alerts.innerHTML = alerts.innerHTML + "<div class='alert alert-danger'>No password entered.</div>";
				}
				
				if ((password2.value == "") && (password1.value != "")){
					valid = false;
					alerts.innerHTML = alerts.innerHTML + "<div class='alert alert-danger'>Password not re-entered.</div>";
				}
				
				if ((password1.value != password2.value) && (password1.value != "") && (password2.value != "")){
					valid = false;
					alerts.innerHTML = alerts.innerHTML + "<div class='alert alert-danger'>Password do not match.</div>";
				}

				
		    			    	
		    }
		  }
		xmlhttp.open("POST","files/registration/check_username.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(param);

		
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