<?php

session_start();
require '../carbon.php';
$carbon = new Carbon();
	 
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

$carbon->setupEnergy($residents, $elec_factor, $gas_factor, $walls, $roof, $windows, $draughts, $boiler, $thermostat, $hours, $hot_water)	
	
?>