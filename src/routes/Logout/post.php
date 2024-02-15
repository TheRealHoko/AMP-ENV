<?php

require_once __DIR__ . "/../../Helpers/body.php";
require_once __DIR__ . "/../../Database/Connection.php";
require_once __DIR__ . "/../../Helpers/response.php";

$statusCode = 500;
try {
    $body = getBody();

    $databaseConnection = getDatabaseConnection();

    $deleteTokenQuery = $databaseConnection->prepare("UPDATE users SET token = NULL WHERE token = :token");

    $deleteTokenQuery->execute([
        "token" => $body["token"]
    ]);

    if (!$deleteTokenQuery->rowCount())
    {
        $statusCode = 404;
        throw new Exception("Token doesn't exist");
    }

    echo jsonResponse(200, ["X-ESGI" => "2ESGI"], [
        "success" => true,
        "message" => "Logged out"
    ]);
} catch (\Throwable $th) {
    echo jsonResponse($statusCode, ["X-ESGI" => "2ESGI"], [
        "success" => false,
        "error" => $exception->getMessage()
    ]);
}