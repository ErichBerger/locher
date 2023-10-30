<?php

require 'functions.php';
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'controllers/index.php',
    '/checkout' => 'controllers/checkout.php',
    '/menu' => 'controllers/menu.php',
    'myaccount' => 'controllers/myaccount.php'
];

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
}
?>