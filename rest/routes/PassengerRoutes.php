<?php
require_once 'services/PassengerService.class.php';

Flight::route('POST /passengers/add', function(){
    $request = Flight::request()->data->getData();
    $passenger = Flight::passengerService()->add($request);
    Flight::json($passenger);
});

