<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 02/07/2016
 * Time: 14:31
 */

namespace Core;


use Core\Helpers\Arr;

class Config
{
    /**
     * Holds the configuration values
     * @var array
     */
    protected static $items = [];

    public static function get(string $key, $default = null)
    {
        static::$items = require APP . 'config.php';

        return Arr::get(static::$items, $key, $default);
    }
}