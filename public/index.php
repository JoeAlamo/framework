<?php
/**
 * Front controller
 * User: Joe Alamo
 * Date: 29/06/2016
 * Time: 13:33
 */

/**
 * Composer
 */
require '../vendor/autoload.php';

$router = new \Core\Routing\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);