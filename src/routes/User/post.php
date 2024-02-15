<?php

require_once __DIR__ . "/../../Entities/CreateUser.php";
require_once __DIR__ . "/../../Helpers/response.php";
require_once __DIR__ . "/../../Helpers/body.php";

try {
    $body = getBody();

    if (!CreateUser($body["email"], $body["password"])) {
        throw new Exception("Unable to create the user");
    }

    echo jsonResponse(200, ["X-ESGI" => "2ESGI"], [
        "success" => true,
        "message" => "Successfully created a user"
    ]);
} catch (Exception $exception) {
    echo jsonResponse(200, ["X-ESGI" => "2ESGI"], [
        "success" => false,
        "error" => $exception->getMessage()
    ]);
}
