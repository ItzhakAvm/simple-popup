<?php

namespace Framework\Routing;

use Framework\Application;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\ResponseFactory;

class Controller
{
    /**
     * Application instance.
     *
     * @var Application
     */
    protected Application $app;

    /**
     * Controller dispatcher instance.
     *
     * @var ControllerDispatcher
     */
    protected ControllerDispatcher $dispatcher;

    /**
     * Controller constructor.
     *
     * @param Application $app
     * @param ControllerDispatcher $dispatcher
     * @return void
     */
    public function __construct(Application $app, ControllerDispatcher $dispatcher)
    {
        $this->app = $app;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Gets the application's request instance.
     *
     * @return Request|null
     */
    protected function request() : Request
    {
        return $this->app->request();
    }

    /**
     * Gets the response factory instance.
     *
     * @return ResponseFactory
     */
    protected function response() : ResponseFactory
    {
        return $this->dispatcher->response();
    }
}