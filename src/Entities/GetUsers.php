<?php

function GetUsers()
{
    require_once __DIR__ . "/../Database/Connection.php";

    $databaseConnection = getDatabaseConnection();

    $getUsersQuery = $databaseConnection->query("SELECT id, email FROM users");

    $users = $getUsersQuery->fetchAll();

    return $users;
}
