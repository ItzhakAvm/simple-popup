<?php

namespace Framework\Routing;

use Framework\Http\Request;

class Route
{
    /**
     * The router instance that owns this route.
     */
    protected Router $router;

    /**
     * Route URI pattern.
     *
     * @var string
     */
    protected string $uri;

    /**
     * HTTP methods the route responds to.
     *
     * @var array
     */
    protected array $methods = [];

    /**
     * Action performed when the route is executed.
     *
     * @var \Closure|string|null
     */
    protected $action = null;

    /**
     * Route constructor.
     *
     * @param Router $router
     * @param string $uri
     * @param array $methods
     * @param \Closure|string $action
     */
    public function __construct(Router $router, string $uri, array $methods, $action)
    {
        $this->router = $router;

        $this->setURI($uri);
        $this->setMethods($methods);
        $this->setAction($action);
    }

    /**
     * Checks whether the route matches the given request.
     *
     * @param Request $request
     * @return bool
     */
    public function check(Request $request) : bool
    {
        return preg_match($this->compiledUri(), $this->formatUri($request->uri()))
            && in_array($request->method(), $this->methods);
    }

    /**
     * Dispatches the route's action.
     *
     * @param Request $request
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function run(Request $request) : void
    {
        if (is_string($this->action)) {
            if (strpos($this->action, '@') === false) {
                throw new \InvalidArgumentException(
                    "Invalid controller and action names `{$this->action}` (must be `controllerName@actionName)."
                );
            }

            list($controller, $action) = explode('@', $this->action, 2);

            $this->router->dispatcher()
                ->dispatch($controller, $action, $this->parseParams($request->uri()));
        } else if ($this->action instanceof \Closure) {
            $this->router->dispatcher()
                ->dispatchClosure($this->action, $this->parseParams($request->uri()));
        } else {
            $type = gettype($this->action);

            throw new \InvalidArgumentException(
                "A route can be either a function or a controller action (controllerName@actionName), {$type} given."
            );
        }
    }

    /**
     * Sets the URI of the route.
     *
     * @param string $uri
     * @return void
     */
    protected function setUri(string $uri) : void
    {
        $this->uri = $this->formatUri($uri);
    }

    /**
     * Checks whether all given HTTP methods are acceptable by the router, and sets them in this route.
     *
     * @param array $methods
     * @return void
     *
     * @throws \UnexpectedValueException
     */
    protected function setMethods(array $methods) : void
    {
        foreach ($methods as $method) {
            $method = strtoupper($method);

            if (! in_array($method, $this->router::METHODS)) {
                throw new \UnexpectedValueException(
                    'One or more of the methods specified to register a route doesn\'t exists.'
                );
            }

            $this->methods[] = $method;
        }
    }

    /**
     * Sets the route action to RouteAction instance.
     *
     * @param \Closure|string $action
     * @return void
     */
    protected function setAction($action) : void
    {
        $this->action = $action;
    }

    /**
     * Converts the route URI to a regex pattern and replaces the parameters to quantifiers, so a real URI can be
     * matched to it.
     *
     * @return string
     */
    protected function compiledUri() : string
    {
        $uri = preg_replace('/{\w+}/', '(.*)', str_replace('/', '\/', $this->uri));

        return "/^{$uri}$/i";
    }

    /**
     * Returns a formatted version of the URI, that removes slashes (/) from it.
     *
     * @param string $uri
     * @return string
     */
    protected function formatUri(string $uri) : string
    {
        return trim($uri, '/');
    }

    /**
     * Parses the params from the given URI according to the route URI.
     *
     * @param string $uri
     * @return array
     */
    protected function parseParams(string $uri) : array
    {
        preg_match($this->compiledUri(), $this->formatUri($uri), $values);

        return array_slice($values, 1);
    }
}