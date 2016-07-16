<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 30/06/2016
 * Time: 14:20
 */

namespace Core\Controllers;


use Symfony\Component\HttpFoundation\Request;

abstract class Controller
{
    protected $request;
    protected $routeParameters = [];

    public function __construct(Request $request, array $routeParameters)
    {
        $this->request = $request;
        $this->routeParameters = $routeParameters;
    }

    /**
     * Append "Action" suffix to controller methods.
     * Call any before filters, then the action, then any after filters.
     * @param string $name
     * @param array $args
     * @throws \BadMethodCallException
     * @return $response
     */
    public function __call(string $name, array $args)
    {
        $method = "{$name}Action";

        if (!method_exists($this, $method)) {
            throw new \BadMethodCallException("Method $method not found in controller " . get_class($this));
        }

        if ($this->before() !== false) {
            $response = call_user_func_array([$this, $method], $args);
            $this->after();
        }

        return $response ?? false;
    }

    /**
     * Before filter - implement to run code before controller actions
     */
    protected function before()
    {

    }

    /**
     * After filter - implement to run code after controller actions
     */
    protected function after()
    {

    }
}