<?php

namespace Framework\Routing;

use Framework\Application;
use Framework\Http\Response;
use Framework\Http\ResponseFactory;
use Framework\Http\Responses\SimpleResponse;

class ControllerDispatcher
{
    /**
     * Application instance.
     *
     * @var Application
     */
    protected Application $app;

    /**
     * Response factory instance.
     *
     * @var ResponseFactory|null
     */
    protected ?ResponseFactory $response = null;

    /**
     * ControllerDispatcher constructor.
     *
     * @param Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Dispatches a controller using controller and action names.
     *
     * @param string $controller
     * @param string $action
     * @param array $params
     * @return void
     *
     * @throws \LogicException|\BadMethodCallException
     */
    public function dispatch(string $controller, string $action, array $params = []) : void
    {
        $class = 'App\\Controllers\\' . $controller;

        if (! class_exists($class)) {
            throw new \LogicException("Controller `{$controller}` not found in this application.");
        } else if (! method_exists($class, $action)) {
            throw new \BadMethodCallException("Method `{$action}` not found in `{$controller}`.");
        }

        $this->handleResponse(
            $this->createController($class)->{$action}(...$params)
        );
    }

    /**
     * Dispatches a closure and binds it to a controller instance.
     *
     * @param \Closure $closure
     * @param array $params
     * @return void
     */
    public function dispatchClosure(\Closure $closure, $params = []) : void
    {
        $this->handleResponse(
            $closure->call($this->createController(Controller::class), ...$params)
        );
    }

    /**
     * Gets the response factory instance.
     *
     * @return ResponseFactory
     */
    public function response() : ResponseFactory
    {
        if ($this->response === null) {
            $this->response = new ResponseFactory($this->app);
        }

        return $this->response;
    }

    /**
     * Creates a new controller instance.
     *
     * @param string $class
     * @return Controller
     */
    protected function createController(string $class) : Controller
    {
        return new $class($this->app, $this);
    }

    /**
     * Handles the response returned from a controller action.
     *
     * @param $response
     * @return void
     */
    protected function handleResponse($response) : void
    {
        if (! $response instanceof Response) {
            $response = $this->response()
                ->simple($response);
        }

        $response->run();
    }
}