<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once __DIR__ . "/Helpers/path.php";
require_once __DIR__ . "/Helpers/method.php";
require_once __DIR__ . "/Helpers/response.php";
require_once __DIR__ . "/Helpers/is_authenticated.php";

if (isPath("/login")) {
    if (isPostMethod()) {
        require_once __DIR__ . "/routes/Login/post.php";
        exit;
    }
}

if (isPath("/logout")) {
    if (isPostMethod()) {
        require_once __DIR__ . "/routes/Logout/post.php";
        exit;
    }
}

if (isPath("/users")) {
    if (!isAuthenticated())
    {
        echo "401 Unauthorized";
        exit;
    }
    if (isGetMethod()) {
        require_once __DIR__ . "/routes/User/get.php";
        exit;
    }

    if (isPostMethod()) {
        require_once __DIR__ . "/routes/User/post.php";
        exit;
    }
}

if (isPath("/users/:id")) {
    if (!isAuthenticated())
    {
        echo "401 Unauthorized";
        exit;
    }
    if (isGetMethod()) {
        require_once __DIR__ . "/routes/User/_id/get.php";
        exit;
    }

    if (isPatchMethod()) {
        require_once __DIR__ . "/routes/User/_id/patch.php";
        exit;
    }

    if (isDeleteMethod()) {
        require_once __DIR__ . "/routes/User/_id/delete.php";
        exit;
    }
}

http_response_code(404);
require_once __DIR__ . "/routes/NotFound.php";
