var conversion_rate = 0.0;
var previousReading = null;
var selected;
var data;
var stage = 1;
var lifestyleData;
var lifeStyleResults = new Object();

updateData();

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(updateGraph);
     
function initialise(){
	updateStatistics();
	updateActivity();
	downloadLifestyleData();
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

function downloadLifestyleData(){
	
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
	    lifestyleData = JSON.parse(xmlhttp.responseText);
	    }
	  }
	xmlhttp.open("GET","files/dashboard/lifestyleData.php",true);
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

function openDailyLifestyleModal(){
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
	    stage = 1;
	    document.getElementById("addDailyLifestyleModal").innerHTML=xmlhttp.responseText;
	    $('#addDailyLifestyle').modal('show');
	    }
	  }
	xmlhttp.open("GET","files/dashboard/dailylifestyle_modal.php",true);
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
			opt2.value = "shorthaul";
			opt3.text = "Transatlantic / Long Haul";
			opt3.value = "longhaul";
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
				
			case "shorthaul":
				conversion_rate = 0.09684;
				break; 
				
			case "longhaul":
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
	
	var units = document.getElementById("distanceUnits").value;
	
	if(units == "miles"){
		distance = distance * 1.609344;
	}
	
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

	var units = document.getElementById("distanceUnits").value;

	if(units == "miles"){
		data.distance = data.distance * 1.609344;
	}

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
		updateGraph();
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
			updateGraph();
		  	}
		  }
		xmlhttp.open("POST","files/dashboard/submit_meter.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(json);
		document.getElementById("meter_body").innerHTML = "<div style='width: 100%; margin-top: 40px; text-align: center;'><img src='files/images/loading.gif' id='loading-indicator'/></div>";
		document.getElementById("meter_submit_button").style.display = "none";
	
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

function updateGraph(){
	
	var period = document.querySelector('input[name="options"]:checked').value;	
	var transport = document.getElementById("transportCheck").checked;
	var energy = document.getElementById("energyCheck").checked;
		
	var param = "transport=" + transport + "&energy=" + energy + "&period=" + period;
		
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
	    	returnData = JSON.parse(xmlhttp.responseText);
	    
	    	var data = google.visualization.arrayToDataTable(returnData);

			var options = {
	          hAxis: {title: returnData[0][0], titleTextStyle: {color: 'red'}},
	          vAxis: {title: 'Carbon Output', titleTextStyle: {color: 'red'}}
	        };

			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
			chart.draw(data, options);
	    }
	  }
	xmlhttp.open("POST","files/dashboard/graphData.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(param);
	
}

function nextStage(){
	
	current = "stage" + stage;
	stage = stage+1;
	next = "stage" + stage;
	
	if(stage <8){
		document.getElementById(current).style.display = "none";
		document.getElementById(next).style.display = "block";
	}
	else if(stage == 8){
		
		document.getElementById(current).style.display = "none";
		document.getElementById(next).style.display = "block";
		
		document.getElementById("lifestyle_next_stage").style.display = "none";
		document.getElementById("lifestyle_submit_button").style.display = "inline";
		
	}
	
}


function updateHotWaterWashing(){

	//Bath
	lifeStyleResults.bath = document.getElementById("hwwBath").value  * 0.06 * 0.1836 * 80;
	document.getElementById("hwwBathCarbon").innerHTML = lifeStyleResults.bath.toFixed(2) + " kge CO2";	
	
	//Electric Showers (Normal or Eco-Power)
	lifeStyleResults.esnep = document.getElementById("hwwESN").value  * 0.06 * 0.5246 * 10;
	document.getElementById("hwwESNCarbon").innerHTML = lifeStyleResults.esnep.toFixed(2) + " kge CO2";	
	
	//Electric Showers (POWER)
	lifeStyleResults.esp = document.getElementById("hwwESP").value  * 0.06 * 0.5246 * 15;
	document.getElementById("hwwESPCarbon").innerHTML = lifeStyleResults.esp.toFixed(2) + " kge CO2";	
	
	//Showers (Normal or Eco-Power)
	lifeStyleResults.snep = document.getElementById("hwwSN").value  * 0.06 * 0.1836 * 10;
	document.getElementById("hwwSNCarbon").innerHTML = lifeStyleResults.snep.toFixed(2) + " kge CO2";	
	
	//Showers (POWER)
	lifeStyleResults.sp = document.getElementById("hwwSP").value  * 0.06 * 0.1836 * 15;
	document.getElementById("hwwSPCarbon").innerHTML = lifeStyleResults.sp.toFixed(2) + " kge CO2";	
	
	//Wash Hands and Face
	lifeStyleResults.whaf = document.getElementById("hwwWHF").value  * 0.06 * 0.1836 * 1;
	document.getElementById("hwwWHFCarbon").innerHTML = lifeStyleResults.whaf.toFixed(2) + " kge CO2";	
	
	//Wash Clothes by Hand
	lifeStyleResults.wch = document.getElementById("hwwWCH").value  * 0.06 * 0.1836 * 5;
	document.getElementById("hwwWCHCarbon").innerHTML = lifeStyleResults.wch.toFixed(2) + " kge CO2";	
	
	//Total
	lifeStyleResults.wwhTotal = lifeStyleResults.bath + lifeStyleResults.esnep + lifeStyleResults.esp + lifeStyleResults.snep + lifeStyleResults.sp + lifeStyleResults.whaf + lifeStyleResults.wch;
	document.getElementById("hwwTotalCarbon").innerHTML = "Total Carbon Output: " + lifeStyleResults.wwhTotal.toFixed(2) + " kge CO2";
	
}

function updateGasElectricAppliances(){
	
	//Gas Cooker
	lifeStyleResults.gasCooker = document.getElementById("geaGasCooker").value  * 0.9 * 0.1836;
	document.getElementById("geaGasCookerCarbon").innerHTML = lifeStyleResults.gasCooker.toFixed(2) + " kge CO2";	
	
	//Electric Cooker
	lifeStyleResults.electricCooker = document.getElementById("geaElectricCooker").value * 0.7 * 0.5246;
	document.getElementById("geaElectricCookerCarbon").innerHTML = lifeStyleResults.electricCooker.toFixed(2) + " kge CO2";	
	
	//Mugs
	lifeStyleResults.kettle = document.getElementById("geaKettle").value * 0.03 * 0.5246;
	document.getElementById("geaKettleCarbon").innerHTML = lifeStyleResults.kettle.toFixed(2) + " kge CO2";	
	
	//Laptops
	lifeStyleResults.laptop = document.getElementById("geaLaptop").value * 0.03 * 0.5246;
	document.getElementById("geaLaptopCarbon").innerHTML = lifeStyleResults.laptop.toFixed(2) + " kge CO2";	
	
	//Desktop
	lifeStyleResults.desktop = document.getElementById("geaDesktop").value * 0.12 * 0.5246;
	document.getElementById("geaDesktopCarbon").innerHTML = lifeStyleResults.desktop.toFixed(2) + " kge CO2";	
	
	//Chargers
	lifeStyleResults.chargers = document.getElementById("geaChargers").value * 0.0005 * 0.5246;
	document.getElementById("geaChargersCarbon").innerHTML = lifeStyleResults.chargers.toFixed(2) + " kge CO2";	
	
	//TV
	lifeStyleResults.tv = document.getElementById("geaTV").value * 0.2 * 0.5246;
	document.getElementById("geaTVCarbon").innerHTML = lifeStyleResults.tv.toFixed(2) + " kge CO2";	
	
	//Electric Fire
	lifeStyleResults.electricFire = document.getElementById("geaElectricFire").value * 1 * 0.5246;
	document.getElementById("geaElectricFireCarbon").innerHTML = lifeStyleResults.electricFire.toFixed(2) + " kge CO2";	
	
	//Electric Blanket
	lifeStyleResults.electricBlanket = document.getElementById("geaElectricBlanket").value * 0.2 * 0.5246;
	document.getElementById("geaElectricBlanketCarbon").innerHTML = lifeStyleResults.electricBlanket.toFixed(2) + " kge CO2";	
	
	//Refrigerator
	lifeStyleResults.fridge = document.getElementById("geaFridge").value * 200 * 0.5246;
	document.getElementById("geaFridgeCarbon").innerHTML = lifeStyleResults.fridge.toFixed(2) + " kge CO2";	
	
	//Energy Efficient Lightbulbs
	lifeStyleResults.energyEfficientLight = document.getElementById("geaEfficientLighbulb").value * 0.015 * 0.5246;
	document.getElementById("geaEfficientLighbulbCarbon").innerHTML = lifeStyleResults.energyEfficientLight.toFixed(2) + " kge CO2";	
	
	//Traditional Lightbulbs
	lifeStyleResults.traditionalLight = document.getElementById("geaOldLightbulb").value * 0.1 * 0.5246;
	document.getElementById("geaOldLightbulbCarbon").innerHTML = lifeStyleResults.traditionalLight.toFixed(2) + " kge CO2";	
		
	//Washing Machine
	lifeStyleResults.washingMachine = document.getElementById("geaWashingMachine").value * 1 * 0.5246;
	document.getElementById("geaWashingMachineCarbon").innerHTML = lifeStyleResults.washingMachine.toFixed(2) + " kge CO2";	
	
	//Tumble Dryer
	lifeStyleResults.tumbleDryer = document.getElementById("geaTumbleDryer").value * 3 * 0.5246;
	document.getElementById("geaTumbleDryerCarbon").innerHTML = lifeStyleResults.tumbleDryer.toFixed(2) + " kge CO2";	
	
	//Hand Wash Dishes
	lifeStyleResults.handWashDishes = document.getElementById("geaHandWashDishes").value * 0.06 * 0.1836 * 6;
	document.getElementById("geaHandWashDishesCarbon").innerHTML = lifeStyleResults.handWashDishes.toFixed(2) + " kge CO2";	
	
	//Dishwasher
	lifeStyleResults.dishwasher = document.getElementById("geaDishwasher").value * 1.5 * 0.5246;
	document.getElementById("geaDishwasherCarbon").innerHTML = lifeStyleResults.dishwasher.toFixed(2) + " kge CO2";
	
	//TOTAL	
	
	
}

function updateColdWaterAndBottledWater(){
	
	//Toilet
	lifeStyleResults.toilet = document.getElementById("cwbwToilet").value * 0.0003 * 7;
	document.getElementById("cwbwToiletCarbon").innerHTML = lifeStyleResults.toilet.toFixed(2) + " kge CO2";
	
	//Mugs
	lifeStyleResults.kettle = document.getElementById("cwbwKettle").value * 0.0003 * 0.3;
	document.getElementById("cwbwKettleCarbon").innerHTML = lifeStyleResults.kettle.toFixed(2) + " kge CO2";
	
	//GlassofWater
	lifeStyleResults.glassofwater = document.getElementById("cwbwGlassOfWater").value * 0.0003 * 0.3;
	document.getElementById("cwbwGlassOfWaterCarbon").innerHTML = lifeStyleResults.glassofwater.toFixed(2) + " kge CO2";
	
	//BottleofWater
	lifeStyleResults.bottledwater = document.getElementById("cwbwSmallBottledWater").value * 0.0003 * 0.5;
	document.getElementById("cwbwSmallBottledWaterCarbon").innerHTML = lifeStyleResults.bottledwater.toFixed(2) + " kge CO2";
	
	//Brushing Teeth - Tap Running
	lifeStyleResults.brushTeethTapOn = document.getElementById("cwbwBrushTeethRunning").value * 0.0003 * 30;
	document.getElementById("cwbwBrushTeethRunningCarbon").innerHTML = lifeStyleResults.brushTeethTapOn.toFixed(2) + " kge CO2";
	
	//Brushing Teeth - Tap Off
	lifeStyleResults.brushTeethTapOff = document.getElementById("cwbwBrushTeethNotRunning").value * 0.02 * 5;
	document.getElementById("cwbwBrushTeethNotRunningCarbon").innerHTML = lifeStyleResults.brushTeethTapOff.toFixed(2) + " kge CO2";
	
	//Rinse Clothes by Hand Cold Water
	lifeStyleResults.rinseClothes = document.getElementById("cwbwRinceClothes").value * 0.0003 * 25;
	document.getElementById("cwbwRinceClothesCarbon").innerHTML = lifeStyleResults.rinseClothes.toFixed(2) + " kge CO2";
	
	//Total
	lifeStyleResults.cwbwTotal = lifeStyleResults.toilet + lifeStyleResults.kettle + lifeStyleResults.glassofwater + lifeStyleResults.bottledwater + lifeStyleResults.brushTeethTapOn + lifeStyleResults.brushTeethTapOff + lifeStyleResults.rinseClothes;
	document.getElementById("cwbwTotalCarbon").innerHTML = "Total Carbon Output: " + lifeStyleResults.cwbwTotal.toFixed(2) + " kge CO2";
	
}

function updateMeals(){
	
}

function updateShopping(){
	
	//Money spent on consumer goods
	lifeStyleResults.consumerGoods = document.getElementById("sPSOG").value * 0.78;
	document.getElementById("sPSOGCarbon").innerHTML = lifeStyleResults.consumerGoods.toFixed(2) + " kge CO2";
	
	//Total
	document.getElementById("shoppingTotalCarbon").innerHTML = "Total Carbon Output: " + lifeStyleResults.consumerGoods.toFixed(2) + " kge CO2";
}

function updateRecycling(){
	
}