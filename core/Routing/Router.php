<?php

namespace Core\Routing;

use Symfony\Component\HttpFoundation\Request;
use Core\Helpers\Str;

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
     * @param Request $request Symfony HTTPFoundation request
     *
     * @throws \Exception
     * @throws \BadMethodCallException
     *
     * @return void
     */
    public function dispatch(Request $request)
    {
        $url = $request->getPathInfo();
        if (!$this->match($url)) {
            throw new \Exception('No route matched');
        }

        $controller = $this->getNamespace() . Str::convertToStudlyCaps($this->getParams()['controller']);

        if (!class_exists($controller)) {
            throw new \Exception("Controller class $controller not found");
        }

        $controllerObj = new $controller($this->getParams());
        $action = Str::convertToCamelCase($this->getParams()['action']);

        if (!is_callable([$controllerObj, $action])) {
            throw new \BadMethodCallException("Method $action (in controller $controller) not found or not public");
        }

        $controllerObj->$action();
    }

    /**
     * Retrieve routing table
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Retrieve currently matched parameters
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Get namespace for the controller class. The namespace defined in route options is appended if present.
     * @return string
     */
    protected function getNamespace(): string
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->getParams())) {
            $namespace .= $this->getParams()['namespace'] . '\\';
        }

        return $namespace;
    }

}