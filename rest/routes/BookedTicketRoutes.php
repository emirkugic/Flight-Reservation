<?php
require_once 'services/BookedTicketService.class.php';

/**
 * @OA\Post(
 *     path="/tickets/add",
 *     summary="Add reserved ticket to database",
 *     description="Add ticket",
 *     tags={"Flights"},
 *     @OA\RequestBody(description="Add ticket", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *          @OA\Schema(
 *             @OA\Property(property="booking_date", type="date", example="2023-10-10", description="booking date"),
 *             @OA\Property(property="user_id", type="int", example="1", description="user id"),
 *             @OA\Property(property="flight_id", type="int", example="1", description="flight_id"),
 *             @OA\Property(property="ticket_price", type="double", example="150.42", description="ticket price"),
 *             @OA\Property(property="seat_row", type="string", example="1", description="seat row"),
 *             @OA\Property(property="seat_column", type="string", example="B", description="seat column"),
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
Flight::route('POST /tickets/add', function () {
    $request = Flight::request()->data->getData();
    $booked_ticket = Flight::bookedTicketService()->add($request);
    Flight::json($booked_ticket);
});
