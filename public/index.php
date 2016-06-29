<?php
/**
 * Front controller
 * User: Joe Alamo
 * Date: 29/06/2016
 * Time: 13:33
 */

require "../core/Routing/Router.php";

$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);

$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
    var_dump($router->getParams());
} else {
    echo "No route found for URL $url";
}