<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('GET /users/con-check', function(){
    Flight::userService();
});


Flight::route('POST /users/login', function () {
    $login = Flight::request()->data->getData();
    $user = Flight::userService()->login($login['email']);

    if (count($user) > 0) {
        $user = $user[0];
    }

    if (isset($user['id'])) {
        if ($user['password'] == $login['password']) {
            unset($user['password']);
            $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
            Flight::json(["message" => "Login successful", "token" => $jwt], 200);
        } else {
            Flight::json(["message" => "Wrong password"], 404);
        }
    } else {
        Flight::json(["message" => "User doesn't exist"], 404);
    }
});

Flight::route('POST /users/signup', function () {
    $user = Flight::request()->data->getData();
    $addedUser = Flight::userService()->addUser($user);

    if ($addedUser) {
        Flight::json(["message" => "User created successfully"], 201);
    } else {
        Flight::json(["message" => "Failed to create user"], 500);
    }
});

