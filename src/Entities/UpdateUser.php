<?php

function UpdateUser(string $id, string $email, string $password)
{
    require_once __DIR__ . "/../Database/Connection.php";
    require_once __DIR__ . "/GetUser.php";

    $databaseConnection = getDatabaseConnection();

    $user = GetUser($id);

    if (!$user)
        throw new Exception("User not found");

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $getUserQuery = $databaseConnection->prepare("UPDATE users SET email = :email, password = :password WHERE id = :id");

    $getUserQuery->execute([
        "email" => $email,
        "password" => $passwordHash,
        "id" => $id
    ]);
    
    $success = $getUserQuery->rowCount() != 0;
    
    return $success;
}
