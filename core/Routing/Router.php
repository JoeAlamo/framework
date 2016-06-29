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
    public function add(string $route, array $params = [])
    {
        // Convert route to regex, escaping forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert route variables
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert route variables with custom regex e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start & end delimiters and case insensitivity
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * Attempt to match given URL to a route in the routing table
     * @param $url
     * @return bool
     */
    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;

                return true;
            }
        }

        return false;
    }

    /**
     * Dispatch the route, creating the controller object and running the
     * action method
     *
     * @param string $url The route URL
     *
     * @return void
     */
    public function dispatch(string $url)
    {
        if (!$this->match($url)) {
            die("No route matched");
        }

        $controller = $this->convertToStudlyCaps($this->params['controller']);

        if (!class_exists($controller)) {
            die("Controller class $controller not found");
        }

        $controllerObj = new $controller();
        $action = $this->convertToCamelCase($this->params['action']);

        if (!is_callable([$controllerObj, $action])) {
            die("Method $action (in controller $controller) not found or not public");
        }

        $controllerObj->$action();
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

    /**
     * Convert the string with hyphens to StudlyCaps,
     * e.g. post-authors => PostAuthors
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    protected function convertToStudlyCaps(string $string): string
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
    protected function convertToCamelCase(string $string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }
}