<?php

Flight::route('GET /users/con-check', function () {
    Flight::userService();
});

/**
 * @OA\Post(
 *     path="/users/login",
 *     summary="Login student based on their email and password",
 *     description="Login user",
 *     tags={"Users"},
 *     @OA\RequestBody(description="User login", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *          @OA\Schema(
 *             @OA\Property(property="email", type="string", example="johndoe123@gmail.com", description="User's email"),
 *             @OA\Property(property="password", type="string", example="johndoe123@", description="User's password"),
 *         )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="User logged in successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Login failed"
 *     )
 * )
 */
Flight::route('POST /users/login', function () {
    $login = Flight::request()->data->getData();
    $response = Flight::userService()->login($login);

    if ($response['status']) {
        unset($response['status']);
        Flight::json($response, 200);
    } else {
        Flight::json(["message" => $response['message']], 404);
    }
});

/**
 * @OA\Post(
 *     path="/users/signup", 
 *     summary="Sign up new student.",
 *     description="Sign up user",
 *     tags={"Users"},
 *     @OA\RequestBody(description="User login", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *          @OA\Schema(
 *             @OA\Property(property="email", type="string", example="newuser@gmail.com", description="User's email"),
 *             @OA\Property(property="password", type="string", example="password123", description="User's password"),
 *             @OA\Property(property="first_name", type="string", example="Lejla", description="User's name"),
 *             @OA\Property(property="last_name", type="string", example="Muratovic", description="User's surname"),
 *         )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="User registered successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Registration failed"
 *     )
 * )
 */
Flight::route('POST /users/signup', function () {
    $user = Flight::request()->data->getData();
    $addedUser = Flight::userService()->addUser($user);

    if (isset($addedUser['status']) && $addedUser['status'] == 'error') {
        Flight::json(["message" => $addedUser['message']], 400);
    } elseif ($addedUser) {
        Flight::json(["message" => "User created successfully"], 201);
    } else {
        Flight::json(["message" => "Failed to create user"], 500);
    }
});

/**
 * @OA\Get(
 *     path="/users/account/{id}",
 *     tags={"Users"},
 *     summary="Get user by id",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *         description="User ID",
 *     ),
 *     @OA\Response(response=200, description="User fetched successfully"),
 * )
 */
Flight::route('GET /users/account/@id', function ($id) {
    Flight::json(Flight::userService()->getUser($id));
});

/**
 * @OA\Put(
 *     path="/users/account/{id}",
 *     summary="Update user by id ",
 *     security={{"ApiKeyAuth": {}}},
 *     description="Update user by id",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *         description="User ID",
 *     ),
 *     @OA\RequestBody(description="User update", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *          @OA\Schema(
 *             @OA\Property(property="username", type="string", example="User1", description="User's username"),
 *             @OA\Property(property="password", type="string", example="Password123", description="User's password"),
 *             @OA\Property(property="email", type="string", example="user1@gmail.com", description="User's email"),
 *         )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Failed to update user"
 *     )
 * )
 */
Flight::route('PUT /users/account/@id', function ($id) {
    $user = Flight::request()->data->getData();
    $updatedUser = Flight::userService()->updateUser($id, $user);

    if (isset($updatedUser['status']) && $updatedUser['status'] == 'error') {
        Flight::json(["message" => $updatedUser['message']], 400);
    } elseif ($updatedUser) {
        Flight::json(["message" => "User updated successfully"], 200);
    } else {
        Flight::json(["message" => "Failed to update user"], 500);
    }
});
