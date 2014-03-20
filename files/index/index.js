
var formValidity = true;

var current = "sect_1";

function openSect(id){
	
	sect = "sect_" + id;

	if (current != sect){
	
		document.getElementById(sect).className = "index_cont visible";
		document.getElementById(current).className = "index_cont hidden";
		current = sect;
	}
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
		    	location.replace("registration.php");
		    }
		  }
		xmlhttp.open("POST","files/registration/register_user_details.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(param);
		
	}
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
