<?php
/**
 * Front controller
 * User: Joe Alamo
 * Date: 29/06/2016
 * Time: 13:33
 */

/**
 * Twig
 */
require_once dirname(__DIR__) . '/vendor/Twig/Autoloader.php';
Twig_Autoloader::register();

/**
 * Autoloader
 */

spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $file;
    }
});

$router = new \Core\Routing\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);