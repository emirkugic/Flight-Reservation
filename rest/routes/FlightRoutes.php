<?php
require_once 'services/FlightService.class.php';

Flight::route('GET /flights/con-check', function(){
    $userService = Flight::userService();
});

Flight::route('POST /flights/search', function(){
    $request = Flight::request()->data->getData();
    $flights = Flight::flightService()->searchFlights($request['departure_airport'], $request['departure_date'], $request['destination_airport'], $request['arrival_date']);
    Flight::json($flights);
});
