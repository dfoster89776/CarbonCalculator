<?php

session_start();
require '../carbon.php';
$carbon = new Carbon();
	 
$residents = $_POST['residents'];
$electricity = $_POST['electricity'];
$gas = $_POST['gas'];
$walls = $_POST['walls'];
$roof = $_POST['roof'];
$windows = $_POST['windows_doors'];
$draughts = $_POST['draughts'];
$hot_water = $_POST['hot_water'];
$boiler = $_POST['boiler'];
$thermostat = $_POST['thermostat'];
$hours = $_POST['hours'];

$carbon->setupEnergy($residents, $electricity, $gas, $walls, $roof, $windows, $draughts, $boiler, $thermostat, $hours, $hot_water);
	
?>