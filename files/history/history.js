google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);



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
	
	if(value == "year" || value == "month" || value == "week" || value == "day"){
		var year = document.getElementById("yearOptions").value;
		param = param + "&year=" + year;
	}
	if(value == "month" || value == "week" || value == "day"){
		var month = document.getElementById("monthOptions").value;
		param = param + "&month=" + month;
	}
	if(value == "week" || value == "day"){
		var week = document.getElementById("weekOptions").value;
		param = param + "&week=" + week;
	}
	if(value == "day"){
		var day = document.getElementById("dayOptions").value;
		alert(day);
		param = param + "&day=" + day;
	}
	
	
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
	    drawChart();
	    }
	  }
	xmlhttp.open("POST","files/history/overview.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
	
	var xmlhttp2;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp2=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp2.onreadystatechange=function()
	  {
	  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
	    {
	    document.getElementById("activity").innerHTML=xmlhttp2.responseText;
	    }
	  }
	xmlhttp2.open("POST","files/history/activity.php",true);
	xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp2.send(param);

	
}


function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {'width': 300,
               'height': 300,
               'chartArea': {'width': '95%', 'height': '95%'},
               'legend': {'position': 'none'},
               'backgroundColor': { 'fill':'transparent' }
		};

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
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
	xmlhttp.open("POST","files/history/activity_modal.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}

function deleteActivity(id){
	
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
	    updateActivity();
	    updateStatistics();
	    }
	  }
	xmlhttp.open("POST","files/history/deleteActivity.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}