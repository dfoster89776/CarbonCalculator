<?php
session_start();
require '../carbon.php';
$carbon = new Carbon();

$carco2 = $_POST['carco2'];
$carType = $_POST['cartype'];

$carbon->setupTransport($carco2, $carType);
?>