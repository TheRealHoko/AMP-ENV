<?php

$request = explode("?", $_SERVER["REQUEST_URI"]);

$routes = [
	"/" => "/View/Home.php",
	"/user" => "/Api/User/get.php",
	"/NotFound" => ["/View/NotFound.php", 404]
];

$route = $request[0] ?? '/NotFound';

if (array_key_exists($route, $routes))
{
	if (is_string($routes[$route]))
    {
		require_once __DIR__ . $routes[$route];
        exit;
    }
	else if (is_array($routes[$route]))
    {
        http_response_code($routes[$route][1]);
        require_once __DIR__ . $routes[$route][0];
        exit;
    }
}
else
{
    http_response_code($routes["/NotFound"][1]);
    require_once __DIR__ . $routes["/NotFound"][0];
}
exit;