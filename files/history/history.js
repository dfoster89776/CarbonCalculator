

function initialise(){


	
}


function updateYearOptions(){
	
	var value = document.getElementById("mainOptions").value;
	
	if(value == "all"){
		updateData();
	}
	
	param = "period=" + value;
	
	
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
	    document.getElementById("yearoptions").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("POST","files/history/year_options.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}

function updateMonthOptions(){
	
	var value = document.getElementById("mainOptions").value;
	var year = document.getElementById("yearOptions").value;
		
	if(value == "year"){
		updateData();
	}
		
	param = "period=" + value + "&year=" + year;
	
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
	    document.getElementById("monthoptions").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("POST","files/history/month_options.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);

	
}

function updateWeekOptions(){
	
	var value = document.getElementById("mainOptions").value;
	var year = document.getElementById("yearOptions").value;
	var month = document.getElementById("monthOptions").value;
		
	if(value == "month"){
		updateData();
	}
		
	param = "period=" + value + "&year=" + year + "&month=" + month;
	
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
	    document.getElementById("weekoptions").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("POST","files/history/week_options.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
}

function updateDayOptions(){
	
	var value = document.getElementById("mainOptions").value;
	var year = document.getElementById("yearOptions").value;
	var month = document.getElementById("monthOptions").value;
	var week = document.getElementById("weekOptions").value;
	
	if(value == "week"){
		updateData();
	}
	
	param = "period=" + value + "&year=" + year + "&month=" + month + "&week=" + week;
		
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
	    document.getElementById("dayoptions").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("POST","files/history/day_options.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
}

function updateData(){
	
	var value = document.getElementById("mainOptions").value;
	
	param = "period=" + value;
	
	
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
	    document.getElementById("overview").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("POST","files/history/overview.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);

	
}