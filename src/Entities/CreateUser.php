<?php

function CreateUser(string $email, string $password): bool
{
    require_once __DIR__ . "/../Database/Connection.php";

    $databaseConnection = getDatabaseConnection();

    $getUserStmt = $databaseConnection->prepare("SELECT COUNT(*) as count FROM users WHERE email = :email");
    $getUserStmt->execute(["email" => $email]);
    $isEmailAlreadyInUse = $getUserStmt->fetch()["count"];
    
    if ($isEmailAlreadyInUse)
        throw new Exception("Email already in use");

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $createComputerQuery = $databaseConnection->prepare("INSERT INTO users (email, password) VALUES(:email, :password)");

    return $createComputerQuery->execute([
        "email" => $email,
        "password" => $passwordHash,
    ]);
}
