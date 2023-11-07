<?php
    $currentTab = 'Home';
    require 'views/index.views.php';







/* Note: the following code is in case we're able to do a router.
It'll allow us to have more direct control over the url path, and where
links lead to.

    require 'functions.php';
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

echo "<p>$uri</p>";
var_dump($_SERVER['REQUEST_URI']);
$routes = [
    '/~ics325fa2302/' => 'controllers/index.php',
    '/~ics325fa2302/checkout' => 'controllers/checkout.php',
    '/~ics325fa2302/menu' => 'controllers/menu.php',
    '/~ics325fa2302/myaccount' => 'controllers/myaccount.php'
];

var_dump($routes);

if (array_key_exists($uri, $routes)) {
    echo "This means the if statement is working";
    require ($routes[$uri]);
}
*/
?>