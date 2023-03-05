<?php

$routes = [
    "/" => "controllers/landing-page.php",
];

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

routeToController($uri, $routes);

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)){
        require $routes[$uri];
    } else {
        http_response_code(404);
        echo "Page not found";
        die();
    }
}