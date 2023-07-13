<?php
require_once 'services/BookedTicketService.class.php';


Flight::route('POST /tickets/add', function(){
    $request = Flight::request()->data->getData();
    $booked_ticket = Flight::bookedTicketService()->add($request);
    Flight::json($booked_ticket);
});

