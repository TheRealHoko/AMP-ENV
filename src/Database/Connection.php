<?php

    function getDatabaseConnection()
    {
        $password = $_ENV["MYSQL_ROOT_PASSWORD"];

        $pdo = new PDO(
            "mysql:host=db;dbname=esgi", "root", $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
        return $pdo;
    }