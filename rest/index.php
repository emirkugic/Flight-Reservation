<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

require_once 'C:\wamp64\www\Flight-Reservation\vendor\autoload.php';

// import and register all business logic files (services) to FlightPHP
require_once 'services/UserService.class.php';
Flight::register('userService', 'UserService');

// import all routes
require_once __DIR__ . '/routes/UserRoutes.php';

//searching flights routes, services and dao
require_once __DIR__ . '/dao/FlightDao.class.php';
require_once __DIR__ . '/services/FlightService.class.php';
// Import routes
require_once __DIR__ . '/routes/FlightRoutes.php';
// Register FlightService to be available throughout FlightPHP
Flight::register('flightService', 'FlightService');


Flight::start();
