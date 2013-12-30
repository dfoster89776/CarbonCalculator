var conversion_rate = 0.0;

function initialise(){
		
	updateCategory();
	
}


function updateCategory(){

	var main_category = document.getElementById("main_category").value;
	var subcategory = document.getElementById("sub_category");
	subcategory.innerHTML = "";
	
	switch(main_category){
		
		case "car":
			document.getElementById("subCategory").style.display = "none";
			conversion_rate = 0.3;
			break;
			
		case "motorcycle":
			document.getElementById("subCategory").style.display = "none";
			conversion_rate = 0.14146;
			break;
			
		case "taxi":
			document.getElementById("subCategory").style.display = "none";
			conversion_rate = 0.2121;
			break;
		
		case "coach":
			document.getElementById("subCategory").style.display = "none";
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
			document.getElementById("subCategory").style.display = "block";
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
			document.getElementById("subCategory").style.display = "block";
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
			document.getElementById("subCategory").style.display = "block";
			break;
		
	}
	
	document.getElementById("conversion_rate").innerHTML = conversion_rate;
	updateSubCategory();
	updateCarbon();
	
}


function updateSubCategory(){
	
		var sub_category = document.getElementById("sub_category").value;

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
		
		document.getElementById("conversion_rate").innerHTML = conversion_rate;
		updateCarbon();
}


function updateCarbon(){
	
	var carbon = "-";
	
	var distance = document.getElementById("distance").value;
	
	if (distance != ""){
		
		distance = parseFloat(distance);
		carbon = distance * conversion_rate;
		carbon = carbon + " kge CO2";
	}
	
	
	document.getElementById("carbon").innerHTML = carbon;
	
}


function chooseElectric(){
	document.getElementById("previous_reading").innerHTML = data['initial_electricity'];
}

function chooseGas(){
	document.getElementById("previous_reading").innerHTML = data['initial_gas'];
}


