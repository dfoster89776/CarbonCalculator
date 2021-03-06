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
		 $result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, timestamp) VALUES ('$myusername', 'login', NOW())");
	 }
	 
	 function getTeacherStatus(){
		 
		$username = $this->username;
		$this->connectDatabase();	 
		$result = mysqli_query($this->mysqli,"SELECT teacher FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row['teacher'];
	 }
	 
	 function validateViewProfilePermission($friend){
	
		$myusername = $this->username;
		$friendUsername = $friend;
		$this->connectDatabase();
		
		$result = mysqli_query($this->mysqli, "SELECT * FROM drf8_db.friends WHERE username = '$myusername' AND friend_username = '$friendUsername'");
		
		if ($result){
			
			$count = mysqli_num_rows($result);
			
			if ($count == 1){
				return true;
			}
			
		}
		
		$result = mysqli_query($this->mysqli, "SELECT * FROM drf8_db.classes, drf8_db.student_classes WHERE classes.class_number = student_classes.class_id AND classes.coordinator = '$myusername' AND student_classes.username = '$friendUsername'");
		
		if ($result){
			
			$count = mysqli_num_rows($result);
			
			if ($count > 0){
				return true;
			}
			
		}
		
		return false;
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
		 $result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, timestamp) VALUES ('$myusername', 'account_created', NOW())");
		 $result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'registration', 'STEP1', NOW())");
	 }
	 
	 function addPersonalDetails($firstname, $surname){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "UPDATE users SET firstname = '$firstname', surname = '$surname', registration = '2' WHERE username='$myusername'");
		 $result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'registration', 'STEP2', NOW())");
	 }
	 
	 function completeSocial(){
	 	$this->connectDatabase();
		 $this->updateRegistrationStatus(3);
		 $result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'registration', 'STEP3', NOW())");
	 }
	 
	 function completeSetupAdvice(){
	 	$this->connectDatabase();
		$this->updateRegistrationStatus(4);
		$result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'registration', 'STEP4', NOW())");
	 }
	 
	 function setupTransport($carco2, $carType){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "INSERT INTO basic_details (username, car_co2, car_type) VALUES ('$myusername', '$carco2', '$carType')");
		 $this->updateRegistrationStatus(5);
		 $result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'registration', 'STEP5', NOW())");
	 }
	 
	 function setupEnergy($residents, $electricity, $gas, $walls, $roof, $windows, $draughts, $boiler, $thermostat, $hours, $hot_water){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "UPDATE basic_details SET occupants = '$residents', heat_loss_wall = '$walls', heat_loss_roof = '$roof', heat_loss_window = '$windows', heat_loss_draughts = '$draughts', boiler_efficiency = '$boiler', thermostat = '$thermostat', heating_hours = '$hours', heat_loss_water_tank = '$hot_water', initial_electricity = '$electricity', initial_gas = '$gas', initial_reading_date = NOW() WHERE username='$myusername'");
		 $result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'registration', 'STEP6', NOW())");
		 $this->updateRegistrationStatus(10);
	 }
	 
	 function setupLifestyle(){
		 $this->updateRegistrationStatus(10);
		 $result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'registration', 'STEP7', NOW())");
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
	
	function getFriendsName($friend){
		
		$friendUsername = $friend;
		$this->connectDatabase();
		
		$result = mysqli_query($this->mysqli, "SELECT firstname, surname FROM drf8_db.users WHERE username = '$friendUsername'");
		
		if ($result){
			
			$count = mysqli_num_rows($result);
			
			if ($count == 1){
				
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				
				$name = $row['firstname']." ".$row['surname'];
				return $name;
			}
			
		}
		return null;
	}
	
	function friendsTransportCarbonThisMonth($profile){
		
		$myusername = $profile;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.journeys WHERE type = 'journey' AND carbon_item.id = journeys.id AND YEAR(journey_date) = YEAR(NOW())AND MONTH(journey_date) = MONTH(NOW()) AND username = '$myusername';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
		
	}
	
	function friendsTransportCarbonLastMonth($profile){
		
		$myusername = $profile;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.journeys WHERE type = 'journey' AND carbon_item.id = journeys.id AND YEAR(journey_date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(journey_date) = MONTH(NOW() - INTERVAL 1 MONTH) AND username = '$myusername';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
		
	}
	
	function friendsEnergyCarbonThisMonth($profile){
		
		$myusername = $profile;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) AS carbon FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end) as daily_energy WHERE YEAR(date) = YEAR(NOW())AND MONTH(date) = MONTH(NOW())");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon']);
		}else{
			return 0;
		}
	}
	
	function friendsEnergyCarbonLastMonth($profile){
		
		$myusername = $profile;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) AS carbon FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end) as daily_energy WHERE YEAR(date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(date) = MONTH(NOW() - INTERVAL 1 MONTH)");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon']);
		}else{
			return 0;
		}
	}
		
	function friendsLifestyleCarbonThisMonth($profile){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW())AND MONTH(daily_lifestyle.date) = MONTH(NOW()) AND username = '$profile';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
	}
	
	function friendsLifestyleCarbonLastMonth($profile){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(daily_lifestyle.date) = MONTH(NOW() - INTERVAL 1 MONTH) AND username = '$profile';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
		
	}
	
	function friendsLifestyleCarbonOffsetThisMonth($profile){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleOffset) as offset FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW())AND MONTH(daily_lifestyle.date) = MONTH(NOW()) AND username = '$profile';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['offset']);
		}else{
			return 0;
		}
	}
	
	function friendsLifestyleCarbonOffsetLastMonth($profile){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleOffset) as offset FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(daily_lifestyle.date) = MONTH(NOW() - INTERVAL 1 MONTH) AND username = '$profile';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['offset']);
		}else{
			return 0;
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
		$result = mysqli_query($this->mysqli, "SELECT car_co2, car_type FROM basic_details WHERE username='$myusername'");
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
	
	function updateTransport($carco2, $cartype){
		$co2 = $carco2;
		$type = $cartype;
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "UPDATE basic_details SET car_co2 = '$co2', car_type = '$type' WHERE username = '$myusername'");
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
		return $this->getLatestUserActivity($myusername);
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
				} elseif ($data['carbon']['type'] == "lifestyle"){
					$result = mysqli_query($this->mysqli, "SELECT * FROM daily_lifestyle WHERE id = '$id'");
					$data['lifestyle'] = mysqli_fetch_array($result, MYSQLI_ASSOC);
				}
				
				return $data;		
			}
		}
		return null;	
	}
	
	function getLatestUserActivity($profile){
		
		$friendUsername = $profile;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT carbon_item.*, journeys.main_category, journeys.sub_category FROM carbon_item LEFT JOIN journeys ON carbon_item.id = journeys.id WHERE username = '$friendUsername' ORDER BY carbon_item.id DESC LIMIT 10) AS newTable");
		if($result){
			if(mysqli_num_rows($result)){
				
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				return $myArray;
				
			}
		}	
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
	
	function getActivityTotal($profile){
		
		$friendUsername = $profile;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM carbon_item WHERE username = '$friendUsername'");
		
		if($result){
			return mysqli_num_rows($result);
		}else{
			return 0;
		}
	}
	
	function getUserActivity($profile, $start){
		
		$friendUsername = $profile;
		$this->connectDatabase();
		$start = $start;
		$end = $start + 5;
		
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT carbon_item.*, journeys.main_category, journeys.sub_category FROM carbon_item LEFT JOIN journeys ON carbon_item.id = journeys.id WHERE username = '$friendUsername' ORDER BY carbon_item.id DESC LIMIT $start, $end) AS newTable");
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
			
	function getFriendsActivity($start){
	
		$myusername = $this->username;
		$this->connectDatabase();
		$start = $start;
		$end = $start + 5;
		
		$result = mysqli_query($this->mysqli, "SELECT carbon_items.id, username, date_added, carbon_total, type, conversion_rate, journey_date, main_category, sub_category, distance, details FROM (SELECT carbon_item.id, carbon_item.username, date_added, type, carbon_total, conversion_rate FROM carbon_item, friends WHERE carbon_item.username = friends.friend_username AND friends.username = '$myusername' ORDER BY carbon_item.id DESC LIMIT $start, $end) AS carbon_items LEFT JOIN journeys ON carbon_items.id = journeys.id;");
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

	function getFriendsActivityCount(){
	
		$myusername = $this->username;
		$this->connectDatabase();
	
		$result = mysqli_query($this->mysqli, "SELECT count(carbon_items.id) AS count FROM (SELECT id, carbon_item.username, date_added, type, carbon_total, conversion_rate FROM carbon_item, friends WHERE carbon_item.username = friends.friend_username AND friends.username = '$myusername' ORDER BY carbon_item.id DESC) AS carbon_items LEFT JOIN journeys ON carbon_items.id = journeys.id;");
		if($result){
			$result = $result->fetch_array(MYSQL_ASSOC);
			return $result["count"];
		}
		return null;
	
	}
	
	function getUsersJourneysLastWeek($myusername){
		
		if($myusername == null){
			$myusername = $this->username;
		}
		
		$this->connectDatabase();
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT sum(carbon_total) AS carbon_total, journey_date FROM carbon_item, journeys WHERE type = 'journey' AND carbon_item.id = journeys.id AND journey_date > (NOW() - INTERVAL 7 DAY) AND carbon_item.username = '$myusername' GROUP BY journey_date) AS journey_table RIGHT JOIN (SELECT * FROM dates WHERE dates.date > (NOW() - INTERVAL 7 DAY) AND dates.date < NOW()) AS newtable2 ON journey_date = newtable2.date;");
		
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


		return null;
		
	}

	function getUsersEnergyLastWeek($myusername){
		
		if($myusername == null){
			$myusername = $this->username;
		}
		
		$this->connectDatabase();
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT sum(carbon) as carbon_total, carbon_date FROM (SELECT date as carbon_date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end) AS newtable WHERE carbon_date > (NOW() - INTERVAL 7 DAY)  GROUP BY carbon_date) as subtable RIGHT JOIN (SELECT * FROM dates WHERE dates.date > (NOW() - INTERVAL 7 DAY) AND dates.date < NOW()) AS newtable2 ON newtable2.date = subtable.carbon_date ");
		
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


		return null;
		
	}

	function getUsersJourneysLastMonth($myusername){
		
		if($myusername == null){
			$myusername = $this->username;
		}
		
		$this->connectDatabase();
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT carbon_total, newtable2.week FROM (SELECT sum(carbon_total) AS carbon_total, week(journey_date) AS week FROM carbon_item, journeys WHERE type = 'journey' AND carbon_item.id = journeys.id AND journey_date > (NOW() - INTERVAL 5 WEEK) AND carbon_item.username = '$myusername' GROUP BY week) AS journey_table RIGHT JOIN (SELECT WEEK(dates.date) AS week FROM dates WHERE dates.date > (NOW() - INTERVAL 5 WEEK) AND dates.date < NOW() GROUP BY week) AS newtable2 ON journey_table.week = newtable2.week;");
		
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


		return null;
		
	}
		
	function getUsersEnergyLastMonth($myusername){
		
		if($myusername == null){
			$myusername = $this->username;
		}
		
		$this->connectDatabase();
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT carbon_total, newtable2.week FROM (SELECT sum(carbon) as carbon_total, week FROM (SELECT date as carbon_date, sum(carbon_per_day) AS carbon, week(date) as week FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end AND date > (NOW() - INTERVAL 5 WEEK) GROUP BY carbon_date ORDER BY carbon_date ASC) as dailyEnergyCarbon GROUP BY week) as energy RIGHT JOIN (SELECT WEEK(dates.date) AS week FROM dates WHERE dates.date > (NOW() - INTERVAL 5 WEEK) AND dates.date < NOW() GROUP BY week) AS newtable2 ON energy.week = newtable2.week; ");
		
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


		return null;
		
	}
		
	function getUsersJourneysLastYear($myusername){
		
		if($myusername == null){
			$myusername = $this->username;
		}
		
		$this->connectDatabase();
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT carbon_total, newtable2.mon, newtable2.yr FROM (SELECT sum(carbon_total) AS carbon_total, month(journey_date) AS mon, year(journey_date) as yr FROM carbon_item, journeys WHERE type = 'journey' AND carbon_item.id = journeys.id AND journey_date > (NOW() - INTERVAL 5 MONTH) AND carbon_item.username = '$myusername' GROUP BY mon, yr) AS journey_table RIGHT JOIN (SELECT MONTH(dates.date) AS mon, YEAR(dates.date) AS yr FROM dates WHERE dates.date > (NOW() - INTERVAL 5 MONTH) AND dates.date < NOW() GROUP BY mon, yr) AS newtable2 ON journey_table.mon = newtable2.mon AND journey_table.yr = newtable2.yr ORDER BY yr, mon;");
		
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


		return null;
		
	}
	
	function getUsersEnergyLastYear($myusername){
		
		if($myusername == null){
			$myusername = $this->username;
		}
		
		$this->connectDatabase();
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT carbon_total, newtable2.mnth, newtable2.yr FROM (SELECT sum(carbon) as carbon_total, mnth, yr FROM (SELECT date as carbon_date, sum(carbon_per_day) AS carbon, month(date) as mnth, year(date) as yr FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end AND date > (NOW() - INTERVAL 5 MONTH) GROUP BY carbon_date ORDER BY carbon_date ASC) as dailyEnergyCarbon GROUP BY mnth, yr) as energy RIGHT JOIN (SELECT MONTH(dates.date) AS mnth, YEAR(dates.date) as yr FROM dates WHERE dates.date > (NOW() - INTERVAL 5 MONTH) AND dates.date < NOW() GROUP BY mnth) AS newtable2 ON energy.mnth = newtable2.mnth AND energy.yr = newtable2.yr ORDER BY yr, mnth;");
		
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


		return null;
		
	}
	
	function getUsersLifestyleLastWeek($myusername){
		
		if($myusername == null){
			$myusername = $this->username;
		}
		
		$this->connectDatabase();
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT sum(carbon_total) AS carbon_total, daily_lifestyle.date FROM carbon_item, daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND daily_lifestyle.date > (NOW() - INTERVAL 7 DAY) AND carbon_item.username = '$myusername' GROUP BY daily_lifestyle.date) AS lifestyle_table RIGHT JOIN (SELECT * FROM dates WHERE dates.date > (NOW() - INTERVAL 7 DAY) AND dates.date < NOW()) AS newtable2 ON lifestyle_table.date = newtable2.date;");
		
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


		return null;
		
	}
	
	function getUsersLifestyleLastMonth($myusername){
		
		if($myusername == null){
			$myusername = $this->username;
		}
		
		$this->connectDatabase();
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT carbon_total, newtable2.week FROM (SELECT sum(carbon_total) AS carbon_total, week(daily_lifestyle.date) AS week FROM carbon_item, daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND daily_lifestyle.date > (NOW() - INTERVAL 5 WEEK) AND carbon_item.username = '$myusername' GROUP BY week) AS lifestyle_table RIGHT JOIN (SELECT WEEK(dates.date) AS week FROM dates WHERE dates.date > (NOW() - INTERVAL 5 WEEK) AND dates.date < NOW() GROUP BY week) AS newtable2 ON lifestyle_table.week = newtable2.week;");
		
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


		return null;
		
	}
	
	function getUsersLifestyleLastYear($myusername){
		
		if($myusername == null){
			$myusername = $this->username;
		}
		
		$this->connectDatabase();
		$data;
			
		$result = mysqli_query($this->mysqli, "SELECT carbon_total, newtable2.mon, newtable2.yr FROM (SELECT sum(carbon_total) AS carbon_total, month(daily_lifestyle.date) AS mon, year(daily_lifestyle.date) as yr FROM carbon_item, daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND daily_lifestyle.date > (NOW() - INTERVAL 5 MONTH) AND carbon_item.username = '$myusername' GROUP BY mon, yr) AS lifestyle_table RIGHT JOIN (SELECT MONTH(dates.date) AS mon, YEAR(dates.date) AS yr FROM dates WHERE dates.date > (NOW() - INTERVAL 5 MONTH) AND dates.date < NOW() GROUP BY mon, yr) AS newtable2 ON lifestyle_table.mon = newtable2.mon AND lifestyle_table.yr = newtable2.yr ORDER BY yr, mon;");
		
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


		return null;
		
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
	
	function lifestyleCarbonThisMonth(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW())AND MONTH(daily_lifestyle.date) = MONTH(NOW()) AND username = '$myusername';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
	}
	
	function lifestyleCarbonLastMonth(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(daily_lifestyle.date) = MONTH(NOW() - INTERVAL 1 MONTH) AND username = '$myusername';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
		
	}
	
	function lifestyleCarbonOffsetThisMonth(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleOffset) as offset FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW())AND MONTH(daily_lifestyle.date) = MONTH(NOW()) AND username = '$myusername';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['offset']);
		}else{
			return 0;
		}
	}
	
	function lifestyleCarbonOffsetLastMonth(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleOffset) as offset FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(daily_lifestyle.date) = MONTH(NOW() - INTERVAL 1 MONTH) AND username = '$myusername';");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['offset']);
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
		
		
		echo $subCategory;
		$conversionRate = $this->getConversionRate($mainCategory, $subCategory);	
		$carbonTotal = $conversionRate * $distance;
				
		$result = mysqli_query($this->mysqli, "INSERT INTO carbon_item (username, date_added, type, carbon_total, conversion_rate) VALUES ('$myusername', NOW(), 'journey', '$carbonTotal', '$conversionRate')");
		$id = mysqli_insert_id($this->mysqli); 
		$result = mysqli_query($this->mysqli, "INSERT INTO journeys VALUES ('$id', '$date', '$mainCategory', '$subCategory', '$distance', '$details')");
		$result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'carbon_activity', '$id', NOW())");
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
		$result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'carbon_activity', '$id', NOW())");

		return true;
		
	}
	
	function postLifestyle($json){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$data = json_decode($json, true);
		
		$lifestyleTotal = $data['lifestyleTotal'];
		
		$result = mysqli_query($this->mysqli, "INSERT INTO carbon_item (username, date_added, type, carbon_total) VALUES ('$myusername', NOW(), 'lifestyle', '$lifestyleTotal')");
		
		$id = mysqli_insert_id($this->mysqli);
		$timestamp = strtotime($data['date']);
		$date = date("Y-m-d", $timestamp);
		$bath = $data['bath'];
		$esnep = $data['esnep'];
		$esp = $data['esp'];
		$snep = $data['snep'];
		$sp = $data['sp'];
		$whaf = $data['whaf'];
		$wch = $data['wch'];
		$wwhTotal = $data['wwhTotal'];
		$gasCooker = $data['gasCooker'];
		$electricCooker = $data['electricCooker'];
		$kettle1 = $data['kettle1'];
		$laptop = $data['laptop'];
		$desktop = $data['desktop'];
		$chargers = $data['chargers'];
		$tv = $data['tv'];
		$electricFire = $data['electricFire'];
		$electricBlanket = $data['electricBlanket'];
		$fridge = $data['fridge'];
		$energyEfficientLight = $data['energyEfficientLight'];
		$traditionalLight = $data['traditionalLight'];
		$washingMachine = $data['washingMachine'];
		$tumbleDryer = $data['tumbleDryer'];
		$handWashDishes = $data['handWashDishes'];
		$dishwasher = $data['dishwasher'];
		$geaTotal = $data['geaTotal'];
		$toilet = $data['toilet'];
		$kettle2 = $data['kettle2'];
		$glassofwater = $data['glassofwater'];
		$bottledwater = $data['bottledwater'];
		$brushTeethTapOn = $data['brushTeethTapOn'];
		$brushTeethTapOff = $data['brushTeethTapOff'];
		$rinseClothes = $data['rinseClothes'];
		$cwbwTotal = $data['cwbwTotal'];
		$vegetarian = $data['vegetarian'];
		$vegan = $data['vegan'];
		$redMeat = $data['redMeat'];
		$poultry = $data['poultry'];
		$fishSus = $data['fishSus'];
		$fishUnsus = $data['fishUnsus'];
		$cheese = $data['cheese'];
		$egg = $data['egg'];
		$dairy = $data['dairy'];
		$bread = $data['bread'];
		$beer = $data['beer'];
		$wine = $data['wine'];
		$packaging = $data['packaging'];
		$transport = $data['transport'];
		$foodTotal = $data['foodTotal'];
		$consumerGoods = $data['consumerGoods'];
		$aluminiumCansRecycled = $data['aluminiumCansRecycled'];
		$aluminiumCansNotRecycled = $data['aluminiumCansNotRecycled'];
		$steelCansRecycled = $data['steelCansRecycled'];
		$glassBottlesRecycled = $data['glassBottlesRecycled'];
		$paperRecycled = $data['paperRecycled'];
		$clothesRecycled = $data['clothesRecycled'];
		$plasticBottlesRecycled = $data['plasticBottlesRecycled'];
		$plasticBagsNotRecycled = $data['plasticBagsNotRecycled'];
		$foodWaste = $data['foodWaste'];
		$electronicWaste = $data['electronicWaste'];
		$landfillWaste = $data['landfillWaste'];
		$recyclingTotal = $data['recyclingTotal'];
		$lifestyleOffset = $wwhTotal + $geaTotal;
		
		
		$result = mysqli_query($this->mysqli, "INSERT INTO daily_lifestyle VALUES ('$id', '$date', '$bath', '$esnep', '$esp', '$snep', '$sp', '$whaf', '$wch', '$wwhTotal', '$gasCooker', '$electricCooker', '$kettle1', '$laptop', '$desktop', '$chargers', '$tv', '$electricFire', '$electricBlanket', '$fridge', '$energyEfficientLight', '$traditionalLight', '$washingMachine', '$tumbleDryer', '$handWashDishes', '$dishwasher', '$geaTotal', '$toilet', '$kettle2', '$glassofwater', '$bottledwater', '$brushTeethTapOn', '$brushTeethTapOff', '$rinseClothes', '$cwbwTotal', '$vegetarian', '$vegan', '$redMeat', '$poultry', '$fishSus', '$fishUnsus', '$cheese', '$egg', '$dairy', '$bread', '$beer', '$wine', '$packaging', '$transport', '$foodTotal', '$consumerGoods', '$aluminiumCansRecycled', '$aluminiumCansNotRecycled', '$steelCansRecycled', '$glassBottlesRecycled', '$paperRecycled', '$clothesRecycled', '$plasticBottlesRecycled', '$plasticBagsNotRecycled', '$foodWaste', '$electronicWaste', '$landfillWaste', '$recyclingTotal', '$lifestyleTotal', '$lifestyleOffset')");
		
		$result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'carbon_activity', '$id', NOW())");
		
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
			$result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'created_class', '$string', NOW())");
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
			$result = mysqli_query($this->mysqli, "INSERT INTO activity_log (username, activity_type, detail, timestamp) VALUES ('$myusername', 'deleted_class', '$class_code', NOW())");
			return true;
		}
		else{
			return false;
		}
	}
	
	function getUsersFullActivity($user){
		
		$this->connectDatabase();

		$result = mysqli_query($this->mysqli, "SELECT * FROM activity_log WHERE username = '$user' ORDER BY id DESC LIMIT 6");
		
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
	
//HISTORY FUNCTIONS
	function getYearOptions(){
		$myusername = $this->username;	
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT year(date) as yearoption FROM dates, users WHERE dates.date > users.join_date AND dates.date <= NOW() AND users.username = '$myusername' GROUP BY yearoption");
		
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
	
	function getMonthOptions($year){
		$myusername = $this->username;	
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT month(date) as monthoption, year(date) as yearoption FROM dates, users WHERE dates.date > users.join_date AND dates.date <= NOW() AND users.username = '$myusername' AND year(date) = '$year' GROUP BY monthoption, yearoption ORDER BY dates.date");
		
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
	
	function getweekOptions($year, $month){
		$myusername = $this->username;	
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT day(date) as dayoption, week(date) as weekoption, month(date) as monthoption, year(date) as yearoption FROM dates, users WHERE dates.date > users.join_date AND dates.date <= NOW() AND users.username = '$myusername' AND month(date) = '$month' AND year(date) = '$year' GROUP BY weekoption, monthoption, yearoption ORDER BY dates.date");
		
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
	
	function getDayOptions($year, $month, $week){
		$myusername = $this->username;		
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT date FROM dates, users WHERE dates.date > users.join_date AND dates.date <= NOW() AND users.username = '$myusername' AND week(date) = '$week' AND month(date) = '$month' AND year(date) = '$year'");
		
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
	
	function getAllOverviewStatistics(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT type, sum(carbon_total) AS total FROM carbon_item WHERE username = '$myusername' GROUP BY type");

		$data = array();
		$data['transport'] = 0;
		$data['energy'] = 0;
		$data['lifestyle'] = 0;

		if ($result){
			
			$count = mysqli_num_rows($result);
			if ($count){
				
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				
					if($row['type'] == "journey"){
						$data['transport'] = $row['total'];
					}
					if($row['type'] == "meter_reading"){
						$data['energy'] = $row['total'];
					}
					if($row['type'] == "lifestyle"){
						$data['lifestyle'] = $row['total'];
					}
				}
				
				$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleOffset) AS offset FROM carbon_item, daily_lifestyle WHERE carbon_item.id = daily_lifestyle.id AND carbon_item.username = '$myusername'");
				
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
								
				$data['total'] = $data['transport'] + $data['lifestyle'] + $data['energy'] - $row['offset'];
				
				return $data;
								
			}else{
				return null;
			}	
		}else{
			return null;
		}
	}
	
	function getYearOverviewStatistics($year){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$data = array();
		$data['transport'] = 0;
		$data['energy'] = 0;
		$data['lifestyle'] = 0;
		
		//Energy statistics
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) as total FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end) AS energyTable WHERE year(date) = '$year'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['energy'] = $row['total'];
		
		//Transport statistics
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_item.carbon_total) as total FROM carbon_item, journeys WHERE carbon_item.id = journeys.id AND username = '$myusername' AND year(journey_date) = '$year'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['transport'] = $row['total'];

		
		//Lifestyle statistics
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleTotal) as total, sum(lifestyleOffset) as offset FROM carbon_item, daily_lifestyle WHERE carbon_item.id = daily_lifestyle.id AND username = '$myusername' AND year(date) = '$year'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['lifestyle'] = $row['total'];
		
		$data['total'] = $data['energy'] + $data['transport'] + $data['lifestyle'] - $row['offset'];

		return $data;
		
	}
	
	function getMonthOverviewStatistics($year, $month){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$data = array();
		$data['transport'] = 0;
		$data['energy'] = 0;
		$data['lifestyle'] = 0;
		
		//Energy statistics
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) as total FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end) AS energyTable WHERE year(date) = '$year' AND month(date) = '$month'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['energy'] = $row['total'];
		
		//Transport statistics
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_item.carbon_total) as total FROM carbon_item, journeys WHERE carbon_item.id = journeys.id AND username = '$myusername' AND year(journey_date) = '$year' AND month(journey_date) = '$month'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['transport'] = $row['total'];
		
		//Lifestyle statistics
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleTotal) as total, sum(lifestyleOffset) as offset FROM carbon_item, daily_lifestyle WHERE carbon_item.id = daily_lifestyle.id AND username = '$myusername' AND year(date) = '$year' AND month(date) = '$month'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['lifestyle'] = $row['total'];
		
		$data['total'] = $data['energy'] + $data['transport'] + $data['lifestyle'] - $row['offset'];

		return $data;

	}
	
	function getWeekOverviewStatistics($year, $month, $week){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$data = array();
		$data['transport'] = 0;
		$data['energy'] = 0;
		$data['lifestyle'] = 0;
		
		//Energy statistics
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) as total FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end) AS energyTable WHERE year(date) = '$year' AND month(date) = '$month' AND week(date) = '$week'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['energy'] = $row['total'];
		
		//Transport statistics
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_item.carbon_total) as total FROM carbon_item, journeys WHERE carbon_item.id = journeys.id AND username = '$myusername' AND year(journey_date) = '$year' AND month(journey_date) = '$month' AND week(journey_date) = '$week'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['transport'] = $row['total'];
				
		//Lifestyle statistics
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleTotal) as total, sum(lifestyleOffset) as offset FROM carbon_item, daily_lifestyle WHERE carbon_item.id = daily_lifestyle.id AND username = '$myusername' AND year(date) = '$year' AND month(date) = '$month' AND week(date) = '$week'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['lifestyle'] = $row['total'];
		
		$data['total'] = $data['energy'] + $data['transport'] + $data['lifestyle'] - $row['offset'];

		return $data;

	}
	
	function getDayOverviewStatistics($day){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$data = array();
		$data['transport'] = 0;
		$data['energy'] = 0;
		$data['lifestyle'] = 0;
		
		//Energy
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) as total FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username = '$myusername' AND date >= reading_start AND date <= reading_end) AS energyTable WHERE date = '$day'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['energy'] = $row['total'];

		
		//Transport
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_item.carbon_total) as total FROM carbon_item, journeys WHERE carbon_item.id = journeys.id AND username = '$myusername' AND journey_date = '$day'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['transport'] = $row['total'];

		
		//Lifestyle
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleTotal) as total, sum(lifestyleOffset) as offset FROM carbon_item, daily_lifestyle WHERE carbon_item.id = daily_lifestyle.id AND username = '$myusername' AND date = '$day'");
		@$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$data['lifestyle'] = $row['total'];
	
		$data['total'] = $data['energy'] + $data['transport'] + $data['lifestyle'] - $row['offset'];

		return $data;
	}
	
	function getAllActivity(){
	
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT newtable.id as activity_id, type, carbon_total, conversion_rate, journey_date, main_category, sub_category, distance, details, reading, meter_type, reading_start, reading_end, carbon_per_day  FROM (SELECT carbon_item.id, carbon_item.type, carbon_item.carbon_total, carbon_item.conversion_rate, journey_date, main_category, sub_category, distance, details FROM carbon_item LEFT JOIN journeys ON carbon_item.id = journeys.id WHERE username = '$myusername') as newtable LEFT JOIN meter_readings ON newtable.id = meter_readings.id) as newtable2 LEFT JOIN daily_lifestyle ON daily_lifestyle.id = newtable2.activity_id ORDER BY newtable2.activity_id DESC;");
		if($result){
			if(mysqli_num_rows($result)){
				
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				return $myArray;
				
			}
		}	

		
	}
	
	function getYearActivity($year){
	
	$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT newtable.id as activity_id, type, carbon_total, conversion_rate, journey_date, main_category, sub_category, distance, details, reading, meter_type, reading_start, reading_end, carbon_per_day  FROM (SELECT carbon_item.id, carbon_item.type, carbon_item.carbon_total, carbon_item.conversion_rate, journey_date, main_category, sub_category, distance, details FROM carbon_item LEFT JOIN journeys ON carbon_item.id = journeys.id WHERE username = '$myusername') as newtable LEFT JOIN meter_readings ON newtable.id = meter_readings.id) as newtable2 LEFT JOIN daily_lifestyle ON daily_lifestyle.id = newtable2.activity_id WHERE year(journey_date) = '$year' || year(date) = '$year' || year(reading_start) = '$year' || year(reading_end) = '$year' ORDER BY newtable2.activity_id DESC;");
		if($result){
			if(mysqli_num_rows($result)){
				
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				return $myArray;
				
			}
		}	
		
	}
	
	function getMonthActivity($year, $month){
	
	$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT newtable.id as activity_id, type, carbon_total, conversion_rate, journey_date, main_category, sub_category, distance, details, reading, meter_type, reading_start, reading_end, carbon_per_day  FROM (SELECT carbon_item.id, carbon_item.type, carbon_item.carbon_total, carbon_item.conversion_rate, journey_date, main_category, sub_category, distance, details FROM carbon_item LEFT JOIN journeys ON carbon_item.id = journeys.id WHERE username = '$myusername') as newtable LEFT JOIN meter_readings ON newtable.id = meter_readings.id) as newtable2 LEFT JOIN daily_lifestyle ON daily_lifestyle.id = newtable2.activity_id WHERE (year(journey_date) = '$year' AND month(journey_date) = '$month') || (year(date) = '$year' AND month(date) = '$month') || (year(reading_start) = '$year' AND month(reading_start) = '$month') || (year(reading_end) = '$year' AND month(reading_end) = '$month') ORDER BY newtable2.activity_id DESC;");
		if($result){
			if(mysqli_num_rows($result)){
				
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				return $myArray;
				
			}
		}	
		
	}
	
	function getWeekActivity($year, $month, $week){
	
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT newtable.id as activity_id, type, carbon_total, conversion_rate, journey_date, main_category, sub_category, distance, details, reading, meter_type, reading_start, reading_end, carbon_per_day  FROM (SELECT carbon_item.id, carbon_item.type, carbon_item.carbon_total, carbon_item.conversion_rate, journey_date, main_category, sub_category, distance, details FROM carbon_item LEFT JOIN journeys ON carbon_item.id = journeys.id WHERE username = '$myusername') as newtable LEFT JOIN meter_readings ON newtable.id = meter_readings.id) as newtable2 LEFT JOIN daily_lifestyle ON daily_lifestyle.id = newtable2.activity_id WHERE (year(journey_date) = '$year' AND month(journey_date) = '$month' AND week(journey_date) = '$week') || (year(date) = '$year' AND month(date) = '$month' AND week(date) = '$week') || (year(reading_start) = '$year' AND month(reading_start) = '$month' AND week(reading_start) = '$week') || (year(reading_end) = '$year' AND month(reading_end) = '$month' AND week(reading_end) = '$week') ORDER BY newtable2.activity_id DESC;");
		if($result){
			if(mysqli_num_rows($result)){
				
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				return $myArray;
				
			}
		}	
		
	}
	
	function getDayActivity($day){
	
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT * FROM (SELECT newtable.id as activity_id, type, carbon_total, conversion_rate, journey_date, main_category, sub_category, distance, details, reading, meter_type, reading_start, reading_end, carbon_per_day  FROM (SELECT carbon_item.id, carbon_item.type, carbon_item.carbon_total, carbon_item.conversion_rate, journey_date, main_category, sub_category, distance, details FROM carbon_item LEFT JOIN journeys ON carbon_item.id = journeys.id WHERE username = '$myusername') as newtable LEFT JOIN meter_readings ON newtable.id = meter_readings.id) as newtable2 LEFT JOIN daily_lifestyle ON daily_lifestyle.id = newtable2.activity_id WHERE journey_date = '$day' || date = '$day' || (reading_start <= '$day' && reading_end >= '$day') ORDER BY newtable2.activity_id DESC;");
		if($result){
			if(mysqli_num_rows($result)){
				
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				return $myArray;
				
			}
		}	
		
	}
	
	//GROUP FUNCTIONS
	function getUsersGroups(){
		
		$myusername = $this->username;
		$this->connectDatabase();
		
		$result = mysqli_query($this->mysqli, "SELECT groupNo, groupName, members FROM (SELECT * FROM drf8_db.groups, user_group WHERE groups.groupNo = user_group.group_id AND username = '$myusername') AS groups LEFT JOIN (SELECT group_id, count(username) as members FROM user_group GROUP BY group_id) AS members ON groups.group_id = members.group_id;");
		
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
	
	function addNewGroup($groupName){
		
		$myusername = $this->username;
		$this->connectDatabase();

		$result = mysqli_query($this->mysqli, "INSERT INTO groups (groupName, groupFounded) VALUES ('$groupName', NOW())");
		
		if($result){
			
			$id = mysqli_insert_id($this->mysqli); 
			
			mysqli_query($this->mysqli, "INSERT INTO user_group VALUES ('$myusername', '$id')");
			
			return $id;
			
		}else{
			return "fail";
		}
	}
	
	function leaveGroup($groupNo){
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "DELETE FROM user_group WHERE username = '$myusername' AND group_id = '$groupNo'");
		return true;
	}
	
	function friendsNotInGroup($id){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT friend_username, firstname, surname, userid FROM friends, users, facebook WHERE friends.username = '$myusername' AND users.username = friends.friend_username AND friends.friend_username = facebook.username AND friends.friend_username NOT IN (SELECT username FROM user_group WHERE group_id = '$id');");
		
		if($result){
			if(mysqli_num_rows($result)){
				
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				return $myArray;
			}
		}	
	}
	
	function addFriendToGroup($friend, $group){
	
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "INSERT INTO user_group VALUES ('$friend', '$group')");	
		
		if($result){
			return "true";
		}else{
			return "false";
		}
	}
	
	function getGroupMembers($groupNo){

		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT users.username, firstname, surname, userid FROM users, user_group, facebook WHERE user_group.username = users.username AND users.username = facebook.username AND user_group.group_id = '$groupNo';");
		
		if($result){
			if(mysqli_num_rows($result)){
				
				while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$myArray[] = $row;
				}
				return $myArray;
			}
		}	
	}
	
	function getGroupName($groupNo){
		
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT groupName FROM groups WHERE groupNo = '$groupNo'");
		
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return $row['groupName'];
		}else{
			return null;
		}
		
	}
	
	function groupTransportCarbonThisMonth($groupNo){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.journeys WHERE type = 'journey' AND carbon_item.id = journeys.id AND YEAR(journey_date) = YEAR(NOW())AND MONTH(journey_date) = MONTH(NOW()) AND username IN(SELECT username FROM user_group WHERE group_id = '$groupNo');");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
		
	}
	
	function groupTransportCarbonLastMonth($groupNo){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.journeys WHERE type = 'journey' AND carbon_item.id = journeys.id AND YEAR(journey_date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(journey_date) = MONTH(NOW() - INTERVAL 1 MONTH) AND username IN(SELECT username FROM user_group WHERE group_id = '$groupNo');");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
		
	}
	
	function groupEnergyCarbonThisMonth($groupNo){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) AS carbon FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username  IN(SELECT username FROM user_group WHERE group_id = '$groupNo') AND date >= reading_start AND date <= reading_end) as daily_energy WHERE YEAR(date) = YEAR(NOW())AND MONTH(date) = MONTH(NOW())");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon']);
		}else{
			return 0;
		}
	}
	
	function groupEnergyCarbonLastMonth($groupNo){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon) AS carbon FROM (SELECT date, carbon_per_day AS carbon FROM carbon_item, meter_readings, dates WHERE carbon_item.id = meter_readings.id AND username  IN(SELECT username FROM user_group WHERE group_id = '$groupNo') AND date >= reading_start AND date <= reading_end) as daily_energy WHERE YEAR(date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(date) = MONTH(NOW() - INTERVAL 1 MONTH)");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon']);
		}else{
			return 0;
		}
	}
	
	function groupLifestyleCarbonThisMonth($groupNo){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW())AND MONTH(daily_lifestyle.date) = MONTH(NOW()) AND username  IN(SELECT username FROM user_group WHERE group_id = '$groupNo');");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
	}
	
	function groupLifestyleCarbonLastMonth($groupNo){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(carbon_total) AS carbon_total FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(daily_lifestyle.date) = MONTH(NOW() - INTERVAL 1 MONTH) AND username  IN(SELECT username FROM user_group WHERE group_id = '$groupNo');");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['carbon_total']);
		}else{
			return 0;
		}
		
	}
	
	function groupLifestyleCarbonOffsetThisMonth($groupNo){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleOffset) as offset FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW())AND MONTH(daily_lifestyle.date) = MONTH(NOW()) AND username  IN(SELECT username FROM user_group WHERE group_id = '$groupNo');");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['offset']);
		}else{
			return 0;
		}
	}
	
	function groupLifestyleCarbonOffsetLastMonth($groupNo){
		
		$myusername = $this->username;
		$this->connectDatabase();
		$result = mysqli_query($this->mysqli, "SELECT sum(lifestyleOffset) as offset FROM drf8_db.carbon_item, drf8_db.daily_lifestyle WHERE type = 'lifestyle' AND carbon_item.id = daily_lifestyle.id AND YEAR(daily_lifestyle.date) = YEAR(NOW() - INTERVAL 1 MONTH)AND MONTH(daily_lifestyle.date) = MONTH(NOW() - INTERVAL 1 MONTH) AND username  IN(SELECT username FROM user_group WHERE group_id = '$groupNo');");
		if($result){
			$row = $result->fetch_array(MYSQL_ASSOC);
			return round($row['offset']);
		}else{
			return 0;
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

function convertResultToAssocArray($result){
	
	
}
?>