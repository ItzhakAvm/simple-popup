<?php

namespace Framework\Http;

use Framework\Application;

abstract class Request
{
    /**
     * Application instance.
     */
    protected Application $app;

    /**
     * Request headers.
     *
     * @var array
     */
    protected array $headers = [];

    /**
     * Request inputs (post / get).
     *
     * @var array
     */
    protected array $inputs = [];

    /**
     * Request constructor.
     *
     * @param Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->loadRequestHeaders();
        $this->loadRequestInputs();
    }

    /**
     * Retrieves an header item from the request.
     *
     * @param string $key
     * @return mixed|null
     */
    public function header(string $key)
    {
        return $this->retrieveItem('headers', $key);
    }

    /**
     * Gets the HTTP request method name.
     *
     * @return string
     */
    public function method() : string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Gets the HTTP URI.
     *
     * @return string
     */
    public function uri() : string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * Retrieves all input items from the request.
     *
     * @return array
     */
    public function all() : array
    {
        return $this->retrieveItem('inputs');
    }

    /**
     * Retrieves an input item from the request.
     *
     * @param string $key
     * @return mixed|null
     */
    public function input(string $key)
    {
        return $this->retrieveItem('inputs', $key);
    }

    /**
     * Stores all HTTP request headers.
     *
     * @return void
     */
    protected function loadRequestHeaders() : void
    {
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) != 'HTTP_') {
                continue;
            }

            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $this->headers[$header] = $value;
        }
    }

    /**
     * Stores all HTTP request inputs.
     *
     * @return void
     */
    protected function loadRequestInputs() : void
    {
        $this->inputs = $_REQUEST;
    }

    /**
     * Retrieves an item by the given key from the specified source. If key is not provided, it retrieves all the items
     * from the source.
     *
     * @param string $from
     * @param string $key
     * @return mixed|null
     */
    protected function retrieveItem(string $from, string $key = null)
    {
        if (property_exists($this, $from)) {
            if ($key !== null) {
                if (array_key_exists($key, $this->{$from})) {
                    return $this->{$from}[$key];
                }
            } else {
                return $this->{$from};
            }
        }

        return null;
    }
}