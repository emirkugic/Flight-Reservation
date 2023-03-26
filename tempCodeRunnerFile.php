<?php
Flight::register('flightReservation_dao', "FlightReservationDao");


Flight::route("GET /users", function(){
    Flight::json(Flight::flightReservation_dao()->get_all());
});