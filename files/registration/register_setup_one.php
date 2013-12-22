<?php
session_start();
require '../carbon.php';
$carbon = new Carbon();

$carco2 = $_POST['carco2'];

$carbon->setupTransport($carco2);
?>