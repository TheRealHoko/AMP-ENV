<?php
    $password = $_ENV["MYSQL_ROOT_PASSWORD"];
    $dbname = "ESGI";

    $pdo = new PDO('mysql:host=db;dbname=mysql', 'root', $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
    $pdo->query("USE DATABASE $dbname");

    $pdo->query("CREATE TABLE IF NOT EXISTS users (
        id INTEGER AUTO_INCREMENT NOT_NULL PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT_NULL
    )");

    echo "Migrated";