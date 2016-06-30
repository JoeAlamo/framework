<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 30/06/2016
 * Time: 19:31
 */

namespace Core\Views;


class View
{
    /**
     * Render the given view file
     * @param string $view
     */
    public static function render(string $view)
    {
        $file = "../app/Views/$view";

        if (!is_readable($file)) {
            die("The view $file can't be found");
        }

        require $file;
    }
}