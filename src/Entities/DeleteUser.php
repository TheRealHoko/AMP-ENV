<?php

function DeleteUser(string $id): bool
{
    require_once __DIR__ . "/../Database/Connection.php";
    require_once __DIR__ . "/GetUser.php";

    $databaseConnection = getDatabaseConnection();

    $user = GetUser($id);

    if (!$user) {
        return false;
    }

    $deleteUserQuery = $databaseConnection->prepare("DELETE FROM users WHERE id = :id");

    $success = $deleteUserQuery->execute([
        "id" => $id
    ]);

    return $success;
}
