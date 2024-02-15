<?php

require_once __DIR__ . "/../../../Entities/UpdateUser.php";
require_once __DIR__ . "/../../../Helpers/response.php";
require_once __DIR__ . "/../../../Helpers/parameters.php";
require_once __DIR__ . "/../../../Helpers/body.php";

try {
    $parameters = getParametersForRoute("/users/:id");
    $body = getBody();

    if (!UpdateUser($parameters["id"], $body["email"], $body["password"])) {
        throw new Exception("Unable to update the user");
    }

    echo jsonResponse(200, ["X-ESGI" => "2ESGI"], [
        "success" => true,
        "message" => "Successfully updated the user"
    ]);
} catch (Exception $exception) {
    echo jsonResponse(200, ["X-ESGI" => "2ESGI"], [
        "success" => false,
        "error" => $exception->getMessage()
    ]);
}
