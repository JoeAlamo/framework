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

/**
 * Path definitions
 */
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);
define('CORE', ROOT . 'core' . DIRECTORY_SEPARATOR);

/**
 * Error and exception handling
 */
error_reporting(E_ALL);
set_exception_handler('Core\Exceptions\Handler::handleException');


require APP . 'routes.php';

$router->dispatch($_SERVER['QUERY_STRING']);