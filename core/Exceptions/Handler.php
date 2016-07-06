<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 06/07/2016
 * Time: 19:29
 */

namespace Core\Exceptions;


use Core\Views\View;

class Handler
{
    public static function handleException(\Throwable $e)
    {
        View::render('Errors/debug.twig', [
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'stackTrace' => $e->getTraceAsString(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);

        die();
    }
}