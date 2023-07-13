<?php
require_once 'services/SeatService.class.php';

Flight::route('GET /seats/con-check', function () {
    Flight::seatService();
});

/**
 * @OA\Put(
 *     path="/seats/reserve",
 *     summary="Reserve seat",
 *     description="Reserve seat",
 *     tags={"Seats"},
 *     @OA\RequestBody(description="User update", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *          @OA\Schema(
 *             @OA\Property(property="row", type="string", example="1", description="Seat's row"),
 *             @OA\Property(property="column", type="string", example="B", description="Seat's column"),
 *         )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Seat reserved"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Failed to reserve seat"
 *     )
 * )
 */
Flight::route('PUT /seats/reserve', function () {
    $data = Flight::request()->data->getData();
    $row = $data['row'];
    $column = $data['number'];
    Flight::seatService()->reserveSeat($row, $column);
});
