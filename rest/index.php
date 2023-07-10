<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

require_once 'C:\wamp64\www\Flight-Reservation\vendor\autoload.php';

// import and register all business logic files (services) to FlightPHP
require_once 'services/UserService.class.php';
Flight::register('userService', "UserService");

// import all routes
require_once __DIR__ . '/routes/UserRoutes.php';


Flight::start();
