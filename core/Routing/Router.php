<?php

/**
 * Maintains application routes
 * User: Joe Alamo
 * Date: 29/06/2016
 * Time: 13:55
 */
class Router
{
    /**
     * Associative array of routes, routing table
     * @var array
     */
    protected $routes = [];

    /**
     * Params from current matched route
     * @var array
     */
    protected $params = [];

    /**
     * Add route to routing table
     * @param $route
     * @param $params
     */
    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }

    /**
     * Attempt to match given URL to a route in the routing table
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if ($url === $route) {
                $this->params = $params;

                return true;
            }
        }

        return false;
    }

    /**
     * Retrieve routing table
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Retrieve currently matched parameters
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}