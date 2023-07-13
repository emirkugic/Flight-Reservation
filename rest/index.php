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
require_once __DIR__ . '/services/PassengerService.class.php';
require_once __DIR__ . '/services/BookedTicketService.class.php';

Flight::register('userService', 'UserService');
Flight::register('flightService', 'FlightService');
Flight::register('seatService', 'SeatService');
Flight::register('passengerService', 'PassengerService');
Flight::register('bookedTicketService', 'BookedTicketService');

// middleware method for login
Flight::route('/*', function () {
  //perform JWT decode
  $path = Flight::request()->url;
  if (
    $path == '/users/login' || $path == '/docs.json'
    || $path == '/flights/search' || $path == '/flights/con-check'
    || $path == '/seats/reserve' || $path == '/users/signup' || $path == '/passengers/add' || $path == '/tickets/add'
  ) return TRUE;

  $headers = getallheaders();
  if (!$headers['Authorization']) {
    Flight::json(["message" => "Authorization is missing"], 403);
    return FALSE;
  } else {
    try {
      $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
      Flight::set('user', $decoded);
      return TRUE;
    } catch (\Exception $e) {
      Flight::json(["message" => "Authorization token is not valid"], 403);
      return FALSE;
    }
  }
});

/* REST API documentation endpoint */
Flight::route('GET /docs.json', function () {
  $openapi = \OpenApi\scan('routes');
  header('Content-Type: application/json');
  echo $openapi->toJson();
});

// import all routes
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/FlightRoutes.php';
require_once __DIR__ . '/routes/SeatRoutes.php';
require_once __DIR__ . '/routes/PassengerRoutes.php';
require_once __DIR__ . '/routes/BookedTicketRoutes.php';


Flight::start();
