<?php
require_once 'services/PassengerService.class.php';

/**
 * @OA\Post(
 *     path="/passengers/add",
 *     summary="Add passenger to database",
 *     description="Add passenger",
 *     tags={"Passengers"},
 *     @OA\RequestBody(description="Add passenger", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *          @OA\Schema(
 *             @OA\Property(property="first_name", type="string", example="Emir", description="first name"),
 *             @OA\Property(property="last_name", type="string", example="Emir", description="last name"),
 *             @OA\Property(property="date_of_birth", type="date", example="2000-10-10", description="date of birth"),
 *             @OA\Property(property="passport", type="string", example="123456789", description="passport"),
 *             @OA\Property(property="id_number", type="string", example="123456789", description="id number"),
 *             @OA\Property(property="title", type="string", example="male", description="title"),
 *         )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Passenger added successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Passenger add failed"
 *     )
 * )
 */
Flight::route('POST /passengers/add', function () {
    $request = Flight::request()->data->getData();
    $passenger = Flight::passengerService()->add($request);
    Flight::json($passenger);
});
