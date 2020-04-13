<?php

namespace Framework\Http;

use Framework\Application;
use Framework\Http\Responses\ErrorResponse;
use Framework\Http\Responses\JsonResponse;
use Framework\Http\Responses\SimpleResponse;
use Framework\Http\Responses\ViewResponse;
use Framework\Templating\View;

class ResponseFactory
{
    /**
     * Application instance.
     *
     * @var Application
     */
    protected Application $app;

    /**
     * Response constructor.
     *
     * @param Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Creates a simple response.
     *
     * @param string $content
     * @return Response
     */
    public function simple(string $content)
    {
        return $this->instance(
            new SimpleResponse($content)
        );
    }

    /**
     * Creates a json response.
     *
     * @param array $data
     * @return Response
     */
    public function json(array $data) : Response
    {
        return $this->instance(
            new JsonResponse($data)
        );
    }

    /**
     * Creates a view response.
     *
     * @param string $viewPath
     * @param array $params
     * @return Response
     */
    public function view(string $viewPath, $params = []) : Response
    {
        return $this->instance(
            new ViewResponse($viewPath, $params)
        );
    }

    /**
     * Creates an error response.
     *
     * @param int $code
     * @return Response
     */
    public function abort(int $code = 404) : Response
    {
        return $this->instance(
            new ErrorResponse($code)
        );
    }

    /**
     * Sets the response's application instance.
     *
     * @param Response $response
     * @return Response
     */
    protected function instance(Response $response) : Response
    {
        return $response
            ->setApplication($this->app);
    }
}