<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Test PHP">
        <title>Test PHP</title>
    </head>
    <body>
        <?php
            $password = $_ENV["MYSQL_ROOT_PASSWORD"];

            $pdo = new PDO('mysql:host=db;dbname=mysql', 'root', $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $query = $pdo->query('SHOW VARIABLES like "version"');

            $row = $query->fetch();

            echo 'MySQL version:' . $row['Value'];
        ?>
    </body>
</html>