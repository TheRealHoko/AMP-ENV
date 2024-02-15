<?php

function GetUser(string $id)
{
    require_once __DIR__ . "/../Database/Connection.php";

    $databaseConnection = getDatabaseConnection();

    $getUserQuery = $databaseConnection->prepare("SELECT id, email FROM users WHERE id = :id");

    $getUserQuery->execute([
        "id" => $id
    ]);

    $user = $getUserQuery->fetch();

    return $user;
}
