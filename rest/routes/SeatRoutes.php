<?php
require_once 'services/SeatService.class.php';

Flight::route('GET /seats/con-check', function () {
    Flight::seatService();
});

Flight::route('PUT /seats/reserve', function () {
    $data = Flight::request()->data->getData();
    $row = $data['row'];
    $column = $data['number'];
    Flight::seatService()->reserveSeat($row, $column);
});
