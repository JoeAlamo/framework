<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 16/07/2016
 * Time: 19:13
 */

$router = new \Core\Routing\Router();

$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('/posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('/{controller}/{action}');
$router->add('/{controller}/{id:\d+}/{action}');