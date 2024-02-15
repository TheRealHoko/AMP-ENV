<?php

function login(string $email, string $password)
{
    require_once __DIR__ . "/../../Database/Connection.php";

    $databaseConnection = getDatabaseConnection();

    $getUserQuery = $databaseConnection->prepare("SELECT id, password FROM users WHERE email = :email");

    $success = $getUserQuery->execute([
        "email" => $email
    ]);

    if (!$success) {
        return false;
    }

    $user = $getUserQuery->fetch();

    if (!$user) {
        return false;
    }

    $isPasswordValid = password_verify($password, $user["password"]);

    if (!$isPasswordValid) {
        return false;
    }

    return $user["id"];
}

require_once __DIR__ . "/../../Database/Connection.php";
require_once __DIR__ . "/../../Helpers/response.php";
require_once __DIR__ . "/../../Helpers/body.php";

$statusCode = 500;
try {
    $body = getBody();

    $userId = login($body["email"], $body["password"]);
    if (!$userId)
    {
        $statusCode = 404;
        throw new Exception("Wrong email or password or user doesn't exist");
    }

    $token = bin2hex(random_bytes(16));

    $databaseConnection = getDatabaseConnection();
    $createTokenQuery = $databaseConnection->prepare("UPDATE users SET token = :token WHERE id = :id");

    $createTokenQuery->execute([
        "token" => $token,
        "id" => $userId
    ]);

    echo jsonResponse(200, ["X-ESGI" => "2ESGI"], [
        "success" => true,
        "message" => "Logged in successfully",
        "token" => $token,
    ]);
} catch (Exception $exception) {
    echo jsonResponse($statusCode, ["X-ESGI" => "2ESGI"], [
        "success" => false,
        "error" => $exception->getMessage()
    ]);
}