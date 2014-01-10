function initialise(){
	
	loadOutstandingRequests();
	loadFindFriendsPanel();
}

function loadOutstandingRequests(){
	
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
	    	document.getElementById("outstanding_requests_container").innerHTML = xmlhttp.responseText;
	    
	  	}
	  }
	xmlhttp.open("POST","files/social/outstandingRequests.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	
}

function loadFindFriendsPanel(){
	
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
	    	document.getElementById("find_friends_container").innerHTML = xmlhttp.responseText;
	    
	  	}
	  }
	xmlhttp.open("POST","files/social/findFriendsPanel.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	
}

function addFriend(friend_id){

	document.getElementById("add_" + friend_id).innerHTML = "Processing";
	document.getElementById("add_" + friend_id).disabled = true;
	
	var param = "friend_id=" + friend_id;
	
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
	    	if(xmlhttp.responseText = true){
		    	document.getElementById("add_" + friend_id).innerHTML = "Request Sent";
		    	document.getElementById("add_" + friend_id).className = "btn btn-success";
	    	} else {
		    	document.getElementById("add_" + friend_id).innerHTML = "Try Again";
		    	document.getElementById("add_" + friend_id).className = "btn btn-warning";
		    	document.getElementById("add_" + friend_id).disabled = false;
	    	}
	    
	  	}
	  }
	xmlhttp.open("POST","files/social/requestFriend.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
}


function confirmFriend(friend_id){
	
	var param = "friend_id=" + friend_id;
		
	document.getElementById("confirm_" + friend_id).innerHTML = "Processing";
	document.getElementById("confirm_" + friend_id).disabled = true;
		
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
	    	if(xmlhttp.responseText = true){
		    	document.getElementById("confirm_" + friend_id).innerHTML = "Added";
		    	document.getElementById("confirm_" + friend_id).className = "btn btn-success";
		    	document.getElementById("ignore_" + friend_id).style.display = "none";
	    	} else {
		    	document.getElementById("confirm_" + friend_id).innerHTML = "Try Again";
		    	document.getElementById("confirm_" + friend_id).className = "btn btn-warning";
		    	document.getElementById("confirm_" + friend_id).disabled = false;
	    	}
	    	
	    	setTimeout(function() {
				loadOutstandingRequests();
			}, 10000);
	    
	  	}
	  }
	xmlhttp.open("POST","files/social/confirmFriendRequest.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
}


function ignoreFriend(friend_id){
	
	var param = "friend_id=" + friend_id;
		
	document.getElementById("ignore_" + friend_id).innerHTML = "Processing";
	document.getElementById("ignore_" + friend_id).disabled = true;
		
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
	    	if(xmlhttp.responseText = true){
		    	document.getElementById("ignore_" + friend_id).innerHTML = "Ignored";
		    	document.getElementById("ignore_" + friend_id).className = "btn btn-danger";
		    	document.getElementById("confirm_" + friend_id).style.display = "none";
	    	} else {
		    	document.getElementById("ignore_" + friend_id).innerHTML = "Try Again";
		    	document.getElementById("ignore_" + friend_id).className = "btn btn-warning";
		    	document.getElementById("ignore_" + friend_id).disabled = false;
	    	}
	    
	  	}
	  }
	xmlhttp.open("POST","files/social/ignoreFriendRequest.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
}

