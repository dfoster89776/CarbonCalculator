<?php

class Carbon{

	private $username = NULL;
	private $mysqli;
	private $facebook = NULL;
		
	 function __construct() {
     	      	   
		if(isset($_SESSION['username'])){
			$this->username = $_SESSION['username'];
		}
		date_default_timezone_set('UTC'); 

	 }
	
//GENERAL FUNCTIONS 
	 function userLoggedIn(){
		 if($this->username != NULL){
			 return true;
		 }
		 else{
			 return false;
		 }
	 }
	 
	 function connectDatabase(){
		 $hostname = "drf8.host.cs.st-andrews.ac.uk";
		 $username = "drf8";
		 $password = "sK8e6kua";
		 $database = "drf8_db";
		 $this->mysqli = new mysqli($hostname, $username, $password, $database);
		 if (mysqli_connect_errno()) {
			 printf("Connect failed: %s\n", mysqli_connect_error());
		 exit();
		 }		 
	 }
	 
	 function verifyUser($username, $password){	 
		 $this->connectDatabase();
		 $username = mysqli_real_escape_string($this->mysqli,$username);
		 $password = md5($password);
		 $result = mysqli_query($this->mysqli,"SELECT * FROM users WHERE username='$username' AND password='$password'");
		 $count = $result->num_rows;
		 if($count){
		 	$this->username = $username;
			 return true;
		 }
		 else{
			 return false;
		 }
	 }
	 
	 function getRegistrationStatus(){
	 	$this->connectDatabase();	 
		$username = $this->username;
		$result = mysqli_query($this->mysqli, "SELECT registration FROM users WHERE username='$username'");
		$row = mysqli_fetch_row($result);
		return $row[0];
	 }
	 
	 function getUsersName(){	 
		$username = $this->username;
		$this->connectDatabase();	 
		$result = mysqli_query($this->mysqli,"SELECT firstname, surname FROM users WHERE username='$username'");
		$row = mysqli_fetch_row($result);
		return $row[0]." ".$row[1];		 
	 }
	 
	 function updateLoginDate(){
		 
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "UPDATE users SET last_login = NOW() WHERE username = '$myusername'");

	 }
	 
	 function getTeacherStatus(){
		 
		$username = $this->username;
		$this->connectDatabase();	 
		$result = mysqli_query($this->mysqli,"SELECT teacher FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row['teacher'];
	 }
	 
	 
	 
//REGISTRATION FUNCTIONS
	 function checkUsernameExists($myusername){
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT username FROM users WHERE username = '$myusername'");
		$rowcount=mysqli_num_rows($result);
		
		if($rowcount > 0){
			return true;
		}
		else{
			return false;
		}
	 }
	 
	 function updateRegistrationStatus($stage){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "UPDATE users SET registration = '$stage' WHERE username='$myusername'");
	 }
	 
	 function addUser($myusername, $mypassword, $myemail){
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "INSERT INTO users (username, password, email, join_date, last_login) VALUES ('$myusername', '$mypassword', '$myemail', NOW(), NOW())");
	 }
	 
	 function addPersonalDetails($firstname, $surname){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "UPDATE users SET firstname = '$firstname', surname = '$surname', registration = '2' WHERE username='$myusername'");
	 }
	 
	 function completeSocial(){
		 $this->updateRegistrationStatus(3);
	 }
	 
	 function completeSetupAdvice(){
		$this->updateRegistrationStatus(4);
	 }
	 
	 function setupTransport($carco2){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "INSERT INTO basic_details (username, car_co2) VALUES ('$myusername', '$carco2')");
		 $this->updateRegistrationStatus(5);
	 }
	 
	 function setupEnergy($residents, $electricity, $gas, $walls, $roof, $windows, $draughts, $boiler, $thermostat, $hours, $hot_water){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "UPDATE basic_details SET occupants = '$residents', heat_loss_wall = '$walls', heat_loss_roof = '$roof', heat_loss_window = '$windows', heat_loss_draughts = '$draughts', boiler_efficiency = '$boiler', thermostat = '$thermostat', heating_hours = '$hours', heat_loss_water_tank = '$hot_water', initial_electricity = '$electricity', initial_gas = '$gas', initial_reading_date = NOW() WHERE username='$myusername'");
		 echo $result;
		 $this->updateRegistrationStatus(6);
	 }
	 
	 function setupLifestyle(){
		 $this->updateRegistrationStatus(10);
	 }
	 
	 
//SOCIAL FUNCTIONS
	function initiateFacebook(){
		
		if ($this->facebook == NULL){
					
			if(file_exists("../../facebook/facebook.php")){
				require_once("../../facebook/facebook.php");
			}else{
				require_once("facebook/facebook.php");
			}
		
			$this->facebook = new Facebook(array(
			  'appId'  => '1426418514240505',
			  'secret' => 'dc7b489953aef866c2a4a0bbc3657d17',
			));
			
			$user = null;
			$accesstoken = $this->getFacebookAccessToken();
			
			if($accesstoken != null){
				$this->facebook->setAccessToken($accesstoken);
				$user = $this->facebook->getUser();
			}
		}
	}

	function setFacebookAccessToken($user, $accesstoken){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM facebook WHERE username='$myusername'");
		$rowcount=mysqli_num_rows($result);
		if ($rowcount > 0){
			$result = mysqli_query($this->mysqli, "UPDATE facebook SET facebooktoken='$accesstoken' WHERE username='$myusername'");			
		}
		else{
			$result = mysqli_query($this->mysqli, "INSERT INTO facebook VALUES ('$myusername', '$user', '$accesstoken')");
		}
	}

	function getFacebookAccessToken(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT facebooktoken FROM facebook WHERE username='$myusername'");
		$rowcount=mysqli_num_rows($result);
		if ($rowcount > 0){
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			return $row['facebooktoken'];			
		}
		else{
			return null;
		}
	}
	
	function getFacebookUserId(){	
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT userid FROM facebook WHERE username='$myusername'");
		$rowcount=mysqli_num_rows($result);
		if ($rowcount > 0){
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			return $row['userid'];			
		}
		else{
			return null;
		}

	}
	
	function getFacebookUserImage(){
		
		$user = $this->getFacebookUserId();
		
		if($user != null){
			return "https://graph.facebook.com/".$user."/picture?type=large";
		}
		else{
			return null;	
		}	
	}
	
	function getOtherFacebookUserImageFromUserId($userid){
		return "https://graph.facebook.com/".$userid."/picture?height=300&width=300";
	}
	
	function getFacebookId($friend){
		
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT userid FROM facebook WHERE username = '$friend'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row['userid'];

	}
	
	function loadUserProfile($userid){
		$this->initiateFacebook();
		return $this->facebook->api("/".$userid);
	}
	
	function friendsWhoUseApps(){
	
		$this->initiateFacebook();	
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$this->initiateFacebook();
		
		if ($this-> facebook != NULL){
		
		$friends = $this->facebook->api(array('method' => 'friends.getAppUsers'));
		
		$result = mysqli_query($this->mysqli, "SELECT facebook2.userid FROM drf8_db.facebook, drf8_db.facebook AS facebook2, drf8_db.friends WHERE drf8_db.facebook.username = drf8_db.friends.username AND drf8_db.friends.username = '$myusername' AND facebook2.username = drf8_db.friends.friend_username UNION SELECT userid FROM friend_requests, facebook WHERE requested_user = '$myusername' AND initiating_user = username UNION SELECT userid FROM friend_requests, facebook WHERE initiating_user = '$myusername' AND requested_user = username;");
		
		
		$count = mysqli_num_rows($result);
				
		if($count){
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
			$rows[] = $row['userid'];
			}
		}
		
		if (!isset($rows)){
			return $friends;
		}else{
			$result = array_diff($friends, $rows);	
		}
		
		return $result;
	}
		return null;
	}
	
	function submitFriendRequest($friend_id){
		
		$myusername = $this->username;
		
		//Get user ID for friend
		$this->connectDatabase();
		
		$result = mysqli_query($this->mysqli, "SELECT username FROM facebook WHERE userid='$friend_id'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$username = $row['username'];
				
		//Insert request in request table
		$result = mysqli_query($this->mysqli, "INSERT INTO friend_requests VALUES ('$myusername', '$username', 'false')");
		
		return true;
	}
	
	function getOutstandingRequests(){
		
		$myusername = $this->username;
		
		//Get user ID for friend
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT initiating_user FROM friend_requests WHERE requested_user='$myusername' AND ignored = 'false'");		
		$count = mysqli_num_rows($result);
		if ($count){
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
			$rows[] = $row['initiating_user'];
			}
			
			return $rows;
		
			
		}else{
			return null;
		}
	}
	
	function confirmFriendRequest($friend){
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "DELETE FROM friend_requests WHERE initiating_user = '$friend' AND requested_user = '$myusername'");
		$result = mysqli_query($this->mysqli, "INSERT INTO friends VALUES ('$myusername', '$friend')");
		$result = mysqli_query($this->mysqli, "INSERT INTO friends VALUES ('$friend', '$myusername')");
		
		return true;
	}
	
	function ignoreFriendRequest($friend){
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "UPDATE friend_requests SET ignored = 'true' WHERE initiating_user = '$friend' AND requested_user = '$myusername'");
		
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	function getFriendsList(){
		
		$myusername = $this->username;
		
		//Get user ID for friend
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT firstname, surname, friend_username, userid FROM users, friends, facebook WHERE friends.username='$myusername' AND facebook.username = friends.friend_username AND users.username = friends.friend_username;");	
		
		$count = mysqli_num_rows($result);
		if ($count){
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
			$rows[] = $row;
			}
			
			return $rows;
		
			
		}else{
			return null;
		}

		
	}
	
//ACCOUNT FUNCTIONS
	function removeFacebook(){
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "DELETE FROM facebook WHERE username='$myusername'");
	}
	
	function getOverviewDetails(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM users WHERE username='$myusername'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
		
	}
	
	function getClassDetails($class_code){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT classes.*, CONCAT(users.firstname, ' ', users.surname) AS coordinator_name FROM classes, users WHERE class_number='$class_code' AND users.username = classes.coordinator");
		
		$count = mysqli_num_rows($result);
		
		if ($count){
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$data = array("valid" => true, "class_data" => $row);
		}else{
			$data = array("valid" => false);
		}
		
		return $data;
	} 
	
	function joinClass($class_code){
		
		$myusername = $this->username;
		$this->connectDatabase();

		if ($result = mysqli_query($this->mysqli, "SELECT * FROM classes WHERE class_number='$class_code'")){
			$count = mysqli_num_rows($result);

			if ($count){
				$result = mysqli_query($this->mysqli, "INSERT INTO student_classes (username, class_id) VALUES ('$myusername', '$class_code')");
				if($result){
					return true;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
	}
	
	function getSubscribedClasses(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$result = mysqli_query($this->mysqli, "SELECT * FROM classes, student_classes WHERE username='$myusername' AND class_id = class_number");		
		
		$count = mysqli_num_rows($result);
		if ($count){
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$rows[] = $row;
			}
			
			return $rows;
		
			
		}else{
			return null;
		}
		
	}
	
	function removeClass($class_code){
		
		$myusername = $this->username;
		$this->connectDatabase();
				
		if($result = mysqli_query($this->mysqli, "DELETE FROM student_classes WHERE class_id='$class_code' AND username = '$myusername'")){
			return true;
		} else{
			return false;
		}
	}
	 
//SETUP FUNCTIONS
	function getTransportData(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT car_co2 FROM basic_details WHERE username='$myusername'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	} 
	
	function getEnergyData(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM basic_details WHERE username='$myusername'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
	
	function updateTransport($carco2){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "UPDATE basic_details SET car_co2 = '$carco2' WHERE username = '$myusername'");
		 return $result;
	 }
	 
	 function updateEnergy($json){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 
		 $obj = json_decode($json, true);
		 
		 mysqli_autocommit($this->mysqli, FALSE);
		 
		 if ($obj['residents'] != ""){
		 	 $residents = $obj['residents'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET occupants = '$residents' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['elec_factor'] != ""){
		 	 $elec_factor = $obj['elec_factor'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET electricity_factor = '$elec_factor' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['gas_factor'] != ""){
		 	 $gas_factor = $obj['gas_factor'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET gas_factor = '$gas_factor' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['walls'] != ""){
		 	 $walls = $obj['walls'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET heat_loss_wall = '$walls' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['roof'] != ""){
		 	 $roof = $obj['roof'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET heat_loss_roof = '$roof' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['windows_doors'] != ""){
		 	 $windows_doors = $obj['windows_doors'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET heat_loss_window= '$windows_doors' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['draughts'] != ""){
		 	 $draughts = $obj['draughts'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET heat_loss_draughts = '$draughts' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['hot_water_tank'] != ""){
		 	 $hot_water_tank = $obj['hot_water_tank'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET heat_loss_water_tank = '$hot_water_tank' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['boiler'] != ""){
		 	 $boiler = $obj['boiler'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET boiler_efficiency = '$boiler' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['thermostat'] != ""){
		 	 $thermostat = $obj['thermostat'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET thermostat = '$thermostat' WHERE username = '$myusername'");
		 }
		 
		 if ($obj['hours'] != ""){
		 	 $hours = $obj['hours'];
			 mysqli_query($this->mysqli, "UPDATE basic_details SET heating_hours = '$hours' WHERE username = '$myusername'");
		 }
		 
		 mysqli_commit($this->mysqli); 
		 
		 return true;
		 
	 }

//DATA ACCESS FUNCTIONS		
	
	function getLatestActivity(){
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT carbon_item.*, journeys.main_category, journeys.sub_category FROM carbon_item LEFT JOIN journeys ON carbon_item.id = journeys.id WHERE username = '$myusername' ORDER BY carbon_item.id DESC LIMIT 5) AS newTable");
		if($result){
			if(mysqli_num_rows($result)){
				
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				return $myArray;
				
			}
		}		
		return null;
	}

	function getDashboardData(){
		
		$data = array();
		$data["meterData"] = $this->getMeterData();
		$data["meterConversionRates"] = $this->getMeterConversionRates();
		$data["journeyConversionRates"] = $this->getJourneyConversionRates();
		return $data;
	}
	
	function getActivityData($id){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT * FROM carbon_item WHERE id = '$id'");
		
		if ($result){
			
			if(mysqli_num_rows($result)){
			
				$data['carbon'] = mysqli_fetch_array($result, MYSQLI_ASSOC);
				
				if ($data['carbon']['type'] == "journey"){
					$result = mysqli_query($this->mysqli, "SELECT * FROM journeys WHERE id = '$id'");
					$data['journey'] = mysqli_fetch_array($result, MYSQLI_ASSOC);

				} elseif ($data['carbon']['type'] == "meter_reading"){
					$result = mysqli_query($this->mysqli, "SELECT * FROM meter_readings WHERE id = '$id'");
					$data['meter_reading'] = mysqli_fetch_array($result, MYSQLI_ASSOC);
				}
				
				return $data;		
			}
		}
		return null;	
	}
	
	function deleteActivity($id){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "DELETE FROM carbon_item WHERE id = '$id'");
		
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
//DASHBOARD FUNCTIONS
	function transportCarbonThisMonth(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.journeys WHERE type = 'journey' AND carbon_item.id = journeys.id AND YEAR(journey_date) = YEAR(NOW())AND MONTH(journey_date) = MONTH(NOW()) AND username = '$myusername';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
		
	}
	
	function transportCarbonLastMonth(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.journeys WHERE type = 'journey' AND carbon_item.id = journeys.id AND YEAR(journey_date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(journey_date) = MONTH(NOW() - INTERVAL 1 MONTH) AND username = '$myusername';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
		
	}
	
	function energyCarbonThisMonth(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) AS carbon FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end) as daily_energy WHERE YEAR(date) = YEAR(NOW())AND MONTH(date) = MONTH(NOW())");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon']);
		}else{
			return 0;
		}
	}
	
	function energyCarbonLastMonth(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) AS carbon FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end) as daily_energy WHERE YEAR(date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(date) = MONTH(NOW() - INTERVAL 1 MONTH)");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon']);
		}else{
			return 0;
		}
	}

//POST CARBON ACTIVITY FUNCTIONS

	function getConversionRate($mainCategory, $subCategory){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		if ($mainCategory == "car"){
			$result = mysqli_query($this->mysqli, "SELECT car_co2 FROM basic_details WHERE username = '$myusername'");
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			return $row['car_co2'];	

		}else{
			$result = mysqli_query($this->mysqli, "SELECT rate FROM conversion_rates WHERE main_category = '$mainCategory' AND sub_category = '$subCategory'");
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			return $row['rate'];	
		}
	}
	
	function getJourneyConversionRates(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$data = array();
		
		$result = mysqli_query($this->mysqli, "SELECT car_co2 FROM basic_details WHERE username = '$myusername'");
		$data['userspecific'] = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$result = mysqli_query($this->mysqli, "SELECT * FROM conversion_rates");
		if ($result){	
			$count = mysqli_num_rows($result);
			if ($count){
				
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$data['standard'][] = $row;
				}
			}
		}
		return $data;
	}
	
	function getMeterConversionRates(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT electricity_factor, gas_factor FROM basic_details WHERE username = '$myusername'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
	
	function getMeterData(){
		
		$electricity = null;
		$gas = null;
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT reading, reading_end FROM carbon_item, meter_readings WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND meter_type = 'electricity' ORDER BY reading DESC LIMIT 1");
		
		 if(mysqli_num_rows($result)){
			 $row = $result->fetch_array(MYSQL_ASSOC);
			 $electricity = $row['reading'];
			 $electricityDate = $row['reading_end'];
		 }
		 
		 $result = mysqli_query($this->mysqli, "SELECT reading, reading_end FROM carbon_item, meter_readings WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND meter_type = 'gas' ORDER BY reading DESC LIMIT 1");
		
		 if(mysqli_num_rows($result)){
			 $row = $result->fetch_array(MYSQL_ASSOC);
			 $gas = $row['reading'];
			 $gasDate = $row['reading_end'];
		 }
		 
		 if (($electricity == null) || ($gas == null)){
			 $result = mysqli_query($this->mysqli, "SELECT initial_electricity, initial_gas, initial_reading_date FROM basic_details WHERE username = '$myusername'");
			 $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			 if ($electricity == null){
				 $electricity = $row['initial_electricity'];
				 $electricityDate = $row['initial_reading_date'];
			 }
			 if ($gas == null){
				 $gas = $row['initial_gas'];
				 $gasDate = $row['initial_reading_date'];
			 }
		 }
		
		$data = array('electricity' => $electricity, 'gas' => $gas, 'electricity_date' => $electricityDate, 'gas_date' => $gasDate);
		return $data;
	}

	function postJourney($json){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$obj = json_decode($json, true);
		$timestamp = strtotime($obj['date']);
		$date = date("Y-m-d", $timestamp);
		$mainCategory = $obj['mainCategory'];
		$subCategory = $obj['subCategory'];
		$distance = $obj['distance'];
		$details = $obj['notes'];
				
		$conversionRate = $this->getConversionRate($mainCategory, $subCategory);	
		$carbonTotal = $conversionRate * $distance;
				
		$result = mysqli_query($this->mysqli, "INSERT INTO carbon_item (username, date_added, type, carbon_total, conversion_rate) VALUES ('$myusername', NOW(), 'journey', '$carbonTotal', '$conversionRate')");
		$id = mysqli_insert_id($this->mysqli); 
		$result = mysqli_query($this->mysqli, "INSERT INTO journeys VALUES ('$id', '$date', '$mainCategory', '$subCategory', '$distance', '$details')");
		 
		return true;
		
	}
	
	function postMeter($json){
		
		$myusername = $this->username;
		$this->connectDatabase();
		date_default_timezone_set('UTC');
		
		$meterData = $this->getMeterData();
		$conversionData = $this->getMeterConversionRates();
		$obj = json_decode($json, true);
		$type = $obj['type'];
		$newReading = $obj['newReading'];
		$occupants = $obj['occupants'];
		$startDate = null;
		$endDate = new DateTime();
		
		//Calculate amounts	
		$amount = $newReading - $meterData[$type];
		$conversionRate = null;
		
		if ($amount > 0){
			if ($type == "electricity"){
			 	$startDate = date_create($meterData['electricity_date']);
			 	$conversionRate = $conversionData['electricity_factor'];
			}else if($type == "gas"){
				$startDate = date_create($meterData['gas_date']);
				$conversionRate = $conversionData['gas_factor'];
			}else{
				return false;
			}
		}else{
			return false;
		}

		$interval = date_diff($startDate, $endDate);
		$days = $interval->days;
		date_add($startDate, date_interval_create_from_date_string('1 days'));		
		$carbonOutput = $amount * $conversionRate / $occupants;
		$carbonOutputPerDay = $carbonOutput / $days;
		
		$sqlStartDate = date_format($startDate, 'Y-m-d H:i:s');;
		$sqlEndDate = date_format($endDate, 'Y-m-d H:i:s');;
		
		$result = mysqli_query($this->mysqli, "INSERT INTO carbon_item (username, date_added, type, carbon_total, conversion_rate) VALUES ('$myusername', NOW(), 'meter_reading', '$carbonOutput', '$conversionRate')");
		$id = mysqli_insert_id($this->mysqli);
		$result = mysqli_query($this->mysqli, "INSERT INTO meter_readings VALUES ('$id', '$newReading', '$type', '$sqlStartDate', '$sqlEndDate', '$carbonOutputPerDay')");

		return true;
		
	}
	
//TEACHER FUNCTIONS
	function getClassesTaught(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT class_number, coordinator, module_number, session, count(student_classes.username) AS no_students FROM classes LEFT JOIN student_classes ON classes.class_number = student_classes.class_id WHERE classes.coordinator = '$myusername' GROUP BY classes.class_number");
		
		if ($result){
			
			$count = mysqli_num_rows($result);
			if ($count){
				
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				
				$rows[] = $row;
				}
				
				return $rows;
			
				
			}else{
				return null;
			}	
		}else{
			return null;
		}
		
	}
	
	function getClassStudentDetails($class_code){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM users, student_classes WHERE users.username = student_classes.username AND student_classes.class_id = '$class_code'");
		
		if ($result){
			
			$count = mysqli_num_rows($result);
			if ($count){
				
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				
				$rows[] = $row;
				}
				
				return $rows;
			
				
			}else{
				return null;
			}	
		}else{
			return null;
		}

		
	}
	
	function registerNewClass($moduleNumber, $session){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$string;
		$found = false;
		//Find blank class code
		do {
			$string = randomString(15);
	
			//Check if string exists
			$result = mysqli_query($this->mysqli, "SELECT * FROM classes WHERE class_number = '$string'");
			
			if($result){
				$count = mysqli_num_rows($result);
				if ($count == 0){
					$found = true;
				}
			}
		} while ($found == false);
		
		$result = mysqli_query($this->mysqli, "INSERT INTO classes VALUES ('$string', '$myusername', '$moduleNumber', '$session')");
		
		if($result){
			$data = array("class_number" => $string, "module_number" => $moduleNumber, "session" => $session);
			return $data;
		}else{
			return null;
		}
	}
	
	function deleteClass($class_code){
		
		$myusername = $this->username;
		$this->connectDatabase();

		$result = mysqli_query($this->mysqli, "DELETE FROM classes WHERE class_number = '$class_code'");
		
		if($result){
			return true;
		}
		else{
			return false;
		}
	}
}

function randomString($length){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}
?>