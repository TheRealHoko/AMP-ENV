<?php

require_once __DIR__ . "/../../Entities/GetUsers.php";
require_once __DIR__ . "/../../Helpers/response.php";

try {
    $users = GetUsers();

    echo jsonResponse(200, ["X-ESGI" => "2ESGI"], [
        "success" => true,
        "users" => $users
    ]);
} catch (Exception $exception) {
    echo jsonResponse(500, ["X-ESGI" => "2ESGI"], [
        "success" => false,
        "error" => $exception->getMessage()
    ]);
}
