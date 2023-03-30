<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

require "C:/wamp64/www/Flight-Reservation/vendor/autoload.php";
require "dao/FlightReservationDao.class.php";


Flight::register('flight_dao', "FlightReservationDao");

Flight::route("GET /users", function () {

    Flight::json(Flight::flight_dao()->get_all());
});

Flight::route("GET /users/@id", function ($id) {
    Flight::json(Flight::flight_dao()->get_by_id($id));
});

Flight::route("DELETE /users/@id", function ($id) {
    Flight::flight_dao()->delete($id);
    Flight::json(['message' => "User deleted successfully"]);
});

Flight::route("POST /user", function () {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "User added successfully",
        'data' => Flight::flight_dao()->add($request)
    ]);
});

Flight::route("PUT /user/@id", function ($id) {
    $user = Flight::request()->data->getData();
    Flight::json([
        'message' => "User edit successfully",
        'data' => Flight::flight_dao()->update($user, $id)
    ]);
});

Flight::start();
