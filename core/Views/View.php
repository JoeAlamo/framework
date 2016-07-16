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
    protected static $viewPaths = [
        '../app/Views',
    ];

    public static function render(string $template, array $data = []): string
    {
        return self::renderTemplate($template, $data);
    }

    /**
     * Render the given view file
     * @param string $_view
     * @param array $_data
     * @throws \Exception
     * @return string
     */
    public static function renderFile(string $_view, array $_data = []): string
    {
        $_file = static::$viewPaths[0] . "/$_view";

        if (!is_readable($_file)) {
            throw new \Exception("The view $_file can't be found");
        }

        extract($_data, EXTR_SKIP);

        ob_start();
        include $_file;

        return ob_get_clean();
    }

    /**
     * Render the given view template using Twig
     * @param string $template
     * @param array $data
     * @return string
     */
    public static function renderTemplate(string $template, array $data = []): string
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(static::$viewPaths);
            $twig = new \Twig_Environment($loader);
        }

        return $twig->render($template, $data);
    }
}