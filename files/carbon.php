<?php

class Carbon{

	private $username = NULL;
	private $mysqli;
		
	 function __construct() {
     	      	   
		if(isset($_SESSION['username'])){
			$this->username = $_SESSION['username'];
		}
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
		 $result = mysqli_query($this->mysqli, "INSERT INTO users (username, password, email) VALUES ('$myusername', '$mypassword', '$myemail')");
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
	 
	 function setupEnergy($residents, $elec_factor, $gas_factor, $walls, $roof, $windows, $draughts, $boiler, $thermostat, $hours, $hot_water){
		 $myusername = $this->username;
		 $this->connectDatabase();
		 $result = mysqli_query($this->mysqli, "UPDATE basic_details SET occupants = '$residents', electricity_factor = '$elec_factor', gas_factor = '$gas_factor', heat_loss_wall = '$walls', heat_loss_roof = '$roof', heat_loss_window = '$windows', heat_loss_draughts = '$draughts', boiler_efficiency = '$boiler', thermostat = '$thermostat', heating_hours = '$hours', heat_loss_water_tank = '$hot_water' WHERE username='$myusername'");
		 $this->updateRegistrationStatus(6);
	 }
	 
	 function setupLifestyle(){
		 $this->updateRegistrationStatus(10);
	 }
	 
	 
//SOCIAL FUNCTIONS
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
			$row = mysqli_fetch_row($result);
			return $row[0];			
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
			$row = mysqli_fetch_row($result);
			return $row[0];			
		}
		else{
			return null;
		}

	}
	
	function getFacebookUserImage(){
		
		$user = $this->getFacebookUserId();
		
		if($user != null){
			return "<img src='https://graph.facebook.com/".$user."/picture?type=large' class='img-thumbnail'>";
		}
		else{
			return null;	
		}	
	}
	 
	 
}

?>