<?php



header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

require_once '../vendor/autoload.php';

// import and register all business logic files (services) to FlightPHP
require_once __DIR__ . '/services/UserService.class.php';
require_once __DIR__ . '/services/FlightService.class.php';
require_once __DIR__ . '/services/SeatService.class.php';

Flight::register('userService', 'UserService');
Flight::register('flightService', 'FlightService');
Flight::register('seatService', 'SeatService');

// import all routes
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/FlightRoutes.php';
require_once __DIR__ . '/routes/SeatRoutes.php';


Flight::start();
