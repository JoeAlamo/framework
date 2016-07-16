<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 16/07/2016
 * Time: 19:49
 */

namespace Core\Helpers;


class Str
{
    /**
     * Convert the string with hyphens to StudlyCaps,
     * e.g. post-authors => PostAuthors
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    public static function convertToStudlyCaps(string $string): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Convert the string with hyphens to camelCase,
     * e.g. add-new => addNew
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    public static function convertToCamelCase(string $string): string
    {
        return lcfirst(self::convertToStudlyCaps($string));
    }
}