<?php

Flight::route('GET /users/con-check', function () {
    Flight::userService();
});


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
