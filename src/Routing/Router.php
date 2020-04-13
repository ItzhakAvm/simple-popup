<?php

namespace Framework\Routing;

use Framework\Application;
use Framework\Http\Request;

class Router
{
    /**
     * Application instance.
     */
    protected Application $app;

    /**
     * All routes registered.
     *
     * @var array
     */
    protected array $routes = [];

    /**
     * Controller dispatcher instance.
     *
     * @var ControllerDispatcher|null
     */
    protected ?ControllerDispatcher $dispatcher = null;

    /**
     * All accepted HTTP methods.
     *
     * @var array
     */
    public const METHODS = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

    /**
     * Router constructor.
     *
     * @param Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Registers a new route.
     *
     * @param string $uri
     * @param array $methods
     * @param $action
     * @return Route
     */
    public function register(array $methods, string $uri = null, $action = null) : Route
    {
        return $this->routes[] = new Route($this, $uri, $methods, $action);
    }

    /**
     * Invokes a closure and passes the router instance, so routes can be registered inside the closure.
     *
     * @param \Closure $closure
     * @return void
     */
    public function closure(\Closure $closure) : void
    {
        $closure->__invoke($this);
    }

    /**
     * Finds and executes the relevant route for current request.
     *
     * @throws \Exception
     */
    public function execute() : void
    {
        $request = $this->app->request();
        $route = $this->getMatchedRoute($request);

        if ($route === null) {
            $this->notFoundException();
        } else {
            $route->run($request);
        }
    }

    /**
     * Gets the controller dispatcher instance (after created at first usage).
     *
     * @return ControllerDispatcher
     */
    public function dispatcher()
    {
        if ($this->dispatcher === null) {
            $this->dispatcher = new ControllerDispatcher($this->app);
        }

        return $this->dispatcher;
    }

    /**
     * Returns the first route that matches the provided request.
     *
     * @param Request $request
     * @return Route|null
     */
    protected function getMatchedRoute(Request $request) : ?Route
    {
        foreach ($this->routes as $route) {
            if ($route->check($request)) {
                return $route;
            }
        }

        return null;
    }

    /**
     * Throws a not found (404) exception.
     *
     * @return void
     */
    protected function notFoundException() : void
    {
        $this->dispatcher()
            ->dispatchClosure(function() {
                return $this->response()->abort(404);
            });
    }

    /**
     * If called method is undefined in the class, check whether is an HTTP method, then register a route with this
     * HTTP method.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($name, $arguments)
    {
        if (in_array(strtoupper($name), static::METHODS)) {
            return $this->register([$name], ...$arguments);
        }

        $class = static::class;

        throw new \BadMethodCallException("Call to undefined method {$class}::{$name}()");
    }
}