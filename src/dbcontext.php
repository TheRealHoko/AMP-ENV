<?php
    $password = $_ENV["MYSQL_ROOT_PASSWORD"];

    $pdo = new PDO('mysql:host=db;dbname=mysql', 'root', $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $query = $pdo->query('SHOW VARIABLES like "version"');

    $row = $query->fetch();

    echo 'MySQL version:' . $row['Value'];