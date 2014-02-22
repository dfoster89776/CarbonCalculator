var activity;
var currentlyLoaded = 5;
var activityTab = false;
var loading = false;

$(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height() && activityTab && !loading && (currentlyLoaded < activity)){
		loading = true;
        loadMoreActivity();
    }
});

function initialise(){
	
	loadProfileDashboard();
	activityTotal();
}

function loadProfileDashboard(){
	
	document.getElementById("content").innerHTML = "<div class='row'><div class='col-sm-8' id='statistics'><div style='text-align: center; padding-top: 100px;'><img src='files/images/loading.gif' id='loading-indicator'/></div></div><div class='col-sm-3 col-sm-offset-1' id='recentActivity'><div style='text-align: center; padding-top: 100px;'><img src='files/images/loading.gif' id='loading-indicator'/></div></div></div>";
	document.getElementById("overviewPill").className = "active";
	document.getElementById("statisticsPill").className = "";
	document.getElementById("activityPill").className = "";
	loadRecentActivity();
	loadStatistics();
	activityTab = false;
	
}

function loadRecentActivity(){
	
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
	    document.getElementById("recentActivity").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","files/profile/recentActivity.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	
}

function loadStatistics(){
	
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
	    document.getElementById("statistics").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","files/profile/dashboardStatistics.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	
}


function loadActivityTab(){
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
	    document.getElementById("content").innerHTML=xmlhttp.responseText;
	    document.getElementById("overviewPill").className = "";
	    document.getElementById("statisticsPill").className = "";
	    document.getElementById("activityPill").className = "active";
	    activityTab = true;
	    currentlyLoaded = 5;
	    if (currentlyLoaded >= activity){
	    	document.getElementById("activityList").innerHTML += "<div class='alert alert-success' style='margin-top: 50px;'>No more activities to load.</div>";
	    }
	    }
	  }
	xmlhttp.open("GET","files/profile/activityTab.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	document.getElementById("content").innerHTML = "<div style='text-align: center; padding-top: 100px;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
}

function activityTotal(){
	
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
	xmlhttp.open("GET","files/profile/getActivityTotal.php",true);
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

function loadMoreActivity(){
	
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
	    document.getElementById("activityList").innerHTML += xmlhttp.responseText;
	    activityTab = true;
	    currentlyLoaded += 5;
	    if (currentlyLoaded >= activity){
	    	document.getElementById("activityList").innerHTML += "<div class='alert alert-success' style='margin-top: 50px;'>No more activities to load.</div>";
	    }
	    
	    }
	  }
	xmlhttp.open("POST","files/profile/loadMoreActivity.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);

	loading = false;
	
}