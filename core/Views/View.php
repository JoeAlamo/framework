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
     * @param string $_view
     * @param array $_data
     */
    public static function render(string $_view, array $_data = [])
    {
        $_file = "../app/Views/$_view";

        if (!is_readable($_file)) {
            die("The view $_file can't be found");
        }

        extract($_data, EXTR_SKIP);

        require $_file;
    }
}