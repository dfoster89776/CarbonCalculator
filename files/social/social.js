var currentlyLoaded = 0;
var loading = false;
var activity;

$(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height() && !loading && (currentlyLoaded < activity)){
		loading = true;
		loadFriendsActivity();
    }
});
function initialise(){
	
	loadActivityCount();
	loadFriendsActivity();
	loadOutstandingRequests();
	loadFriendsList();
}

function loadActivityCount(){
	
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
	    	activity = xmlhttp.responseText;
	    
	  	}
	  }
	xmlhttp.open("POST","files/social/friendsActivityCount.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	
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

function loadFriendsActivity(){
	document.getElementById("loading_indicator").style.visibility = "visible";
	param = "loaded=" + currentlyLoaded;
 	
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
	    document.getElementById("loading_indicator").style.visibility = "hidden";
	    document.getElementById("activity_container").innerHTML += xmlhttp.responseText;
	    activityTab = true;
	    currentlyLoaded += 5;
	    if (currentlyLoaded >= activity){
	    	document.getElementById("activity_container").innerHTML += "<div class='alert alert-success' style='margin-top: 50px;'>No more activities to load.</div>";
	    }
	    loading = false;
	    }
	  }
	xmlhttp.open("POST","files/social/friendsActivity.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);

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

function openFindFriendModal(){
	
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
	    	document.getElementById("findFriendsModalContent").innerHTML = xmlhttp.responseText;
	  	}
	  }
	xmlhttp.open("POST","files/social/findFriendsPanel.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	$('#friendsModal').modal('show');
}

function loadFriendsList(){
	
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
	    	document.getElementById("friends_list").innerHTML = xmlhttp.responseText;
	  	}
	  }
	xmlhttp.open("POST","files/social/friendsList.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
}

function openActivityModal(id){
	
	var param = "id=" + id;
		
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
	    document.getElementById("activityModalContent").innerHTML= xmlhttp.responseText;
	    $('#activityModal').modal('show');
	    }
	  }
	xmlhttp.open("POST","files/profile/activity_modal.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}
