var conversion_rate = 0.0;
var previousReading = null;
var selected;
var data;

updateData();

function initialise(){
	updateStatistics();
	updateActivity();
	updateCategory();
}

function updateData(){
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
	    data = JSON.parse(xmlhttp.responseText);
	    }
	  }
	xmlhttp.open("GET","files/dashboard/dashboardData.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();	
}

function updateActivity(){
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
	    document.getElementById("activity_container").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","files/dashboard/activity.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	
}

function openMeterModal(){
	
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
	    document.getElementById("addMeterModal").innerHTML=xmlhttp.responseText;
	    $('#addMeterReading').modal('show');
	    }
	  }
	xmlhttp.open("GET","files/dashboard/meter_modal.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();

	
}

function openJourneyModal(){
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
	    document.getElementById("addJourneyModal").innerHTML=xmlhttp.responseText;
	    updateCategory();
	    $('#addJourney').modal('show');
	    }
	  }
	xmlhttp.open("GET","files/dashboard/journey_modal.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
}

function updateCategory(){

	var main_category = document.getElementById("journeyMainCategory").value;
	var subcategory = document.getElementById("journeySubCategory");
	subcategory.innerHTML = "";
	
	switch(main_category){
		
		case "car":
			document.getElementById("subCategoryDiv").style.display = "none";
			conversion_rate = data['journeyConversionRates']['userspecific']['car_co2'];
			break;
			
		case "motorcycle":
			document.getElementById("subCategoryDiv").style.display = "none";
			conversion_rate = 0.14146;
			break;
			
		case "taxi":
			document.getElementById("subCategoryDiv").style.display = "none";
			conversion_rate = 0.2121;
			break;
		
		case "coach":
			document.getElementById("subCategoryDiv").style.display = "none";
			conversion_rate = 0.0306;
			break;
		
		case "rail":
			var opt1=document.createElement("option");
			var opt2=document.createElement("option");
			var opt3=document.createElement("option");
			var opt4=document.createElement("option");
			opt1.text = "National";
			opt1.value = "national";
			opt2.text = "International (Eurostar)";
			opt2.value = "international";
			opt3.text = "Light Rail and Tram";
			opt3.value = "LRaT";
			opt4.text = "London Underground";
			opt4.value = "londonUnderground";
			subcategory.add(opt1,null);
			subcategory.add(opt2,null);
			subcategory.add(opt3,null);
			subcategory.add(opt4,null);
			document.getElementById("subCategoryDiv").style.display = "block";
			break;
		
		case "plane":
			var opt1=document.createElement("option");
			var opt2=document.createElement("option");
			var opt3=document.createElement("option");
			opt1.text = "Domestic";
			opt1.value = "domestic";
			opt2.text = "European / Short Haul";
			opt2.value = "shortHaul";
			opt3.text = "Transatlantic / Long Haul";
			opt3.value = "longHaul";
			subcategory.add(opt1,null);
			subcategory.add(opt2,null);
			subcategory.add(opt3,null);
			document.getElementById("subCategoryDiv").style.display = "block";
			break;
			
		case "ferry":
			var opt1=document.createElement("option");
			var opt2=document.createElement("option");
			opt1.text = "Passenger";
			opt1.value = "passenger";
			opt2.text = "Car";
			opt2.value = "car";
			subcategory.add(opt1,null);
			subcategory.add(opt2,null);
			document.getElementById("subCategoryDiv").style.display = "block";
			break;
		
	}
	
	document.getElementById("journeyConversionRate").innerHTML = conversion_rate;
	updateSubCategory();
	updateCarbon();
	
}

function updateSubCategory(){
	
		var sub_category = document.getElementById("journeySubCategory").value;

		switch(sub_category){
		
			case "national":
				conversion_rate = 0.0565;
				break; 
				
			case "international":
				conversion_rate = 0.0151;
				break; 
				
			case "LRaT":
				conversion_rate = 0.0715;
				break; 
				
			case "londonUnderground":
				conversion_rate = 0.0736;
				break; 
				
			case "domestic":
				conversion_rate = 0.1648;
				break; 
				
			case "shortHaul":
				conversion_rate = 0.09684;
				break; 
				
			case "longHaul":
				conversion_rate = 0.1115;
				break; 
				
			case "passenger":
				conversion_rate = 0.02254;
				break; 
			
			case "car":
				conversion_rate = 0.15576;
				break; 
		
		}
		
		document.getElementById("journeyConversionRate").innerHTML = conversion_rate;
		updateCarbon();
}

function updateCarbon(){
	
	var carbon = "-";
	
	var distance = document.getElementById("journeyDistance").value;
	
	if (distance != ""){
		
		distance = parseFloat(distance);
		carbon = distance * conversion_rate;
		carbon=carbon.toFixed(2);
		carbon = carbon + " kge CO2";
	}
	
	document.getElementById("journeyCarbon").innerHTML = carbon;
	
}

function submitJourney(){
		
	var data = new Object();
	data.mainCategory = document.getElementById("journeyMainCategory").value;
	data.subCategory = document.getElementById("journeySubCategory").value;
	data.date = document.getElementById("journeyDate").value;
	data.notes = document.getElementById("journeyNotes").value;
	data.distance = document.getElementById("journeyDistance").value;

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
	    updateActivity();
	    document.getElementById("journey_body").innerHTML=xmlhttp.responseText;
	    updateData();
	    updateStatistics();

	  	}
	  }
	xmlhttp.open("POST","files/dashboard/submit_journey.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(json);
	document.getElementById("journey_body").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
	document.getElementById("journey_submit_button").style.display = "none";

}

function submitMeter(){
	
	var data = new Object();
	data.type = selected;
	data.newReading = document.getElementById("meterInputReading").value;
	data.occupants = document.getElementById("occupants").value;

	if (data.newReading > previousReading){

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
		    updateActivity();
		    document.getElementById("meter_body").innerHTML=xmlhttp.responseText;
		    updateData();
		    updateStatistics();

		  	}
		  }
		xmlhttp.open("POST","files/dashboard/submit_meter.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(json);
		document.getElementById("meter_body").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
		document.getElementById("meter_submit_button").style.display = "none";
	}
}

function updateMeterModal(){
	
	newReading = document.getElementById("meterInputReading").value;
	difference = newReading - previousReading;
	
	occupants = document.getElementById('occupants').value;
	
	if(previousReading == null || newReading == ""){
		document.getElementById("meterUsedAmount").innerHTML = " - ";
		document.getElementById("meterCarbon").innerHTML = " - ";
	}
	else{
	
		if (newReading <= previousReading){
			document.getElementById("alerts").innerHTML = "<div class='alert alert-danger'>New Reading must be greater than previous reading.</div>";
			document.getElementById("inputReadingDiv").className = "form-group has-error";
			document.getElementById("meterCarbon").innerHTML = " - ";
			document.getElementById("meterUsedAmount").innerHTML = " - ";
		}
		else{
			document.getElementById("alerts").innerHTML = "";
			document.getElementById("inputReadingDiv").className = "form-group"
			document.getElementById("meterUsedAmount").innerHTML = difference;
			if(selected == 'electricity'){
				carbon = difference * data['meterConversionRates']['electricity_factor'];
				
			}	
			else if(selected == 'gas'){
				carbon = difference * data['meterConversionRates']['gas_factor'];
			}
			carbonPerson = carbon/occupants;
			document.getElementById('meterCarbon').innerHTML = carbon.toFixed(2) + " kge CO2";
			document.getElementById('meterCarbonPerson').innerHTML = carbonPerson.toFixed(2) + " kge CO2";
		}
	}
}

function chooseElectric(){
	previousReading = data['meterData']['electricity'];
	document.getElementById("meterPrevious").innerHTML = previousReading;
	selected = "electricity";
	document.getElementById('meterInputReading').disabled = false;
	updateMeterModal();
}

function chooseGas(){
	previousReading = data['meterData']['gas'];
	document.getElementById("meterPrevious").innerHTML = previousReading;
	selected = "gas";
	document.getElementById('meterInputReading').disabled = false;
	updateMeterModal();
}

function updateStatistics(){
	
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
	    	document.getElementById("statistics").innerHTML = xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","files/dashboard/statistics.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();

	
}

function updateMonthlyCarbonTotal(){
	
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
	xmlhttp.open("POST","files/dashboard/activity_modal.php",true);
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
	xmlhttp.open("POST","files/dashboard/deleteActivity.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}