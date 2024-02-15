<?php
    $password = $_ENV["MYSQL_ROOT_PASSWORD"];

    $pdo = new PDO('mysql:host=db;dbname=mysql', 'root', $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $pdo->query("DROP DATABASE IF EXISTS esgi");
    $pdo->query("CREATE DATABASE IF NOT EXISTS esgi");
    $pdo->query("USE esgi");

    $pdo->query("CREATE TABLE IF NOT EXISTS users (
        id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        token VARCHAR(255)
    )");

    echo "Migrated";