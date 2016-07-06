<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 02/07/2016
 * Time: 14:31
 */

return [
    'db' => [
        'host' => getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost',
        'name' => getenv('DB_NAME') ? getenv('DB_NAME') : 'framework',
        'user' => getenv('DB_USER') ? getenv('DB_USER') : 'user',
        'password' => getenv('DB_PASSWORD') ? getenv('DB_PASSWORD') : 'password'
    ],
    'env' => getenv('APP_ENV') ? getenv('APP_ENV') : 'dev'
];