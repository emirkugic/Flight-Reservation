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

Flight::route('GET /users/account/@id', function ($id) {
    Flight::json(Flight::userService()->getUser($id));
});

//update credentials in my account
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



