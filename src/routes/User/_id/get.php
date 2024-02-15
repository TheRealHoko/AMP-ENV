<?php

require_once __DIR__ . "/../../../Helpers/response.php";
require_once __DIR__ . "/../../../Entities/GetUser.php";
require_once __DIR__ . "/../../../Helpers/parameters.php";

try {
    $parameters = getParametersForRoute("/users/:id");
    $user = GetUser($parameters["id"]);

    if (!$user) {
        echo jsonResponse(404, ["X-ESGI" => "2ESGI"], [
            "success" => false,
            "error" => "Not found"
        ]);

        exit;
    }

    echo jsonResponse(200, ["X-ESGI" => "2ESGI"], [
        "success" => true,
        "user" => $user
    ]);
} catch (Exception $exception) {
    echo jsonResponse(500, ["X-ESGI" => "2ESGI"], [
        "success" => false,
        "error" => $exception->getMessage()
    ]);
}
