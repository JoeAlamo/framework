<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 02/07/2016
 * Time: 14:56
 */

namespace Core\Helpers;


class Arr
{
    /**
     * Retrieve a value from an array, allowing 'dot' notation
     * E.g. 'parent.child.item' => $array['parent']['child']['item']
     * @param array $array
     * @param string $key
     * @param null $default
     * @return array|mixed|null
     */
    public static function get(array $array, string $key, $default = null)
    {
        if (!is_array($array)) {
            return $default;
        }
        
        if ($key == null) {
            return $array;
        }

        // If it's within the first level, return it
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        // Iterate through segments - if we encounter a dead end, return the default val
        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }

    /**
     * Set a value in the array, allowing 'dot' notation
     * @param array $array
     * @param string $key
     * @param $value
     * @return array|mixed
     */
    public static function set(array &$array, string $key, $value)
    {
        if ($key == null) {
            return $array = $value;
        }

        $keys = explode('.', $key);

        while (count($keys) > 1) {
            $key = array_shift($keys);

            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if (! isset($array[$key]) || ! is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }
}