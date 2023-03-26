<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

// require "../vendor/autoload.php";
require "dao/FlightReservationDao.class.php";


$newConn = new FlightReservationDao();
$newConn->update("emir", "kugic", "emirkugic@gmail.com", 16);
$results= $newConn->get_all();
print_r($results);

?>