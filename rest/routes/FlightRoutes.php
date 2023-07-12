<?php
require_once 'services/FlightService.class.php';

/**
 * @OA\Post(
 *     path="/flights/search",
 *     summary="Search flights based on departure and arrival airport and dates",
 *     description="Search flights",
 *     tags={"Flights"},
 *     @OA\RequestBody(description="User login", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *          @OA\Schema(
 *             @OA\Property(property="departure_airport", type="string", example="Sarajevo", description="departure airport"),
 *             @OA\Property(property="destination_airport", type="string", example="Mexico City", description="destination airport"),
 *             @OA\Property(property="departure_date", type="date", example="20-09-2023", description="departure date"),
 *             @OA\Property(property="arrival_date", type="date", example="21-09-2023", description="arrival date")
 *         )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Search successful"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Search failed"
 *     )
 * )
 */
Flight::route('POST /flights/search', function () {
    $request = Flight::request()->data->getData();
    $flights = Flight::flightService()->searchFlights($request['departure_airport'], $request['departure_date'], $request['destination_airport'], $request['arrival_date']);
    Flight::json($flights);
});
