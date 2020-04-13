<?php

namespace Framework\Http;

use Framework\Application;

abstract class Response
{
    /**
     * Application instance.
     *
     * @var Application
     */
    protected ?Application $app = null;

    /**
     * Response headers list.
     *
     * @var array
     */
    protected array $headers = [];

    /**
     * @var mixed
     */
    protected $content;

    /**
     * Renders the response content.
     *
     * @return void
     */
    protected abstract function render() : void;

    /**
     * Response constructor.
     *
     * @param $content
     * @return void
     */
    public function __construct($content)
    {
        $this->setContent($content);
    }

    /**
     * Registers the headers to the response and run it.
     */
    public function run() : void
    {
        $this->registerHeaders();
        $this->render();
    }

    /**
     * Gets the response content.
     *
     * @return mixed
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * Sets the application instance.
     *
     * @param Application $app
     * @return $this
     */
    public function setApplication(Application $app) : self
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Sets the response content.
     *
     * @param $content
     * @return $this
     */
    public function setContent($content) : self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Sets the response content type.
     *
     * @param $contentType
     * @return $this
     */
    public function setContentType($contentType) : self
    {
        $this->header('Content-Type', $contentType);

        return $this;
    }

    /**
     * Sets the response status code.
     *
     * @param int $code
     * @return $this
     */
    public function setStatusCode($code = 200) : self
    {
        http_response_code($code);

        return $this;
    }

    /**
     * Adds or modifies a response header item.
     *
     * @param string $name
     * @param string|int $value
     *
     * @return $this
     */
    public function header(string $name, $value) : self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Registers the headers to the response.
     *
     * @return void
     */
    protected function registerHeaders() : void
    {
        foreach ($this->headers as $header => $value) {
            header("$header: $value");
        }
    }
}