<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 06/07/2016
 * Time: 19:29
 */

namespace Core\Exceptions;


use Core\Config;
use Core\Views\View;
use Symfony\Component\HttpFoundation\Response;

class Handler
{
    public static function handleException(\Throwable $e)
    {
        static::log($e);

        if (Config::get('debug')) {
            (new Response(
                View::render('Errors/debugOn.twig', [
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                    'stackTrace' => $e->getTraceAsString(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ])
            ))->send();
        } else {
            (new Response(
                View::render('Errors/debugOff.twig')
            ))->send();
        }
    }

    protected static function log(\Throwable $e)
    {
        $log = ROOT . 'storage/Logs/' . date('Y-m-d') . '.log';
        $time = date('H:i:s');

        $message = "[$time] Uncaught exception: '" . get_class($e) . "'";
        $message .= " with message '{$e->getMessage()}'\n";
        $message .= "Stack trace: {$e->getTraceAsString()} \n";
        $message .= "Thrown in {$e->getFile()} on line {$e->getLine()} \n\n";

        error_log($message, 3, $log);
    }
}