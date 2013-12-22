<?php

session_start();

require '../database_connection/db_connection.php';
	
$tbl_name="users"; // Table name 
 
$myusername = $_SESSION['username'];

$residents = $_POST['residents'];
$elec_factor = $_POST['elec_factor'];
$gas_factor = $_POST['gas_factor'];
$walls = $_POST['walls'];
$roof = $_POST['roof'];
$windows = $_POST['windows_doors'];
$draughts = $_POST['draughts'];
$hot_water = $_POST['hot_water'];
$boiler = $_POST['boiler'];
$thermostat = $_POST['thermostat'];
$hours = $_POST['hours'];

$sql="UPDATE basic_details SET occupants = '$residents', electricity_factor = '$elec_factor', gas_factor = '$gas_factor', heat_loss_wall = '$walls', heat_loss_roof = '$roof', heat_loss_window = '$windows', heat_loss_draughts = '$draughts', boiler_efficiency = '$boiler', thermostat = '$thermostat', heating_hours = '$hours', heat_loss_water_tank = '$hot_water' WHERE username='$myusername'";
$result=mysql_query($sql);

// To protect MySQL injection (more detail about MySQL injection)
$sql="UPDATE users SET registration = '6' WHERE username='$myusername'";
$result=mysql_query($sql);

$_SESSION['registration'] = 6;

include_once("register.php");	
	
?>