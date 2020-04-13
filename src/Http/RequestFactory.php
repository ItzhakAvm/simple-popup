<?php

namespace Framework\Http;

use Framework\Application;
use Framework\Http\Requests\SimpleRequest;
use Framework\Http\Requests\JsonRequest;

class RequestFactory
{
    /**
     * Creates a request instance according to the HTTP request content type.
     *
     * @param Application $app
     * @return JsonRequest|SimpleRequest
     */
    public static function create(Application $app) : Request
    {
        switch (static::contentType()) {
            case 'application/json':
            case 'application/ld+json':
                return static::createJsonRequest($app);
            default:
                return static::createSimpleRequest($app);
        }
    }

    /**
     * Creates a simple request instance.
     *
     * @param Application $app
     * @return SimpleRequest
     */
    protected static function createSimpleRequest(Application $app) : SimpleRequest
    {
        return new SimpleRequest($app);
    }

    /**
     * Creates a json request instance.
     *
     * @param Application $app
     * @return JsonRequest
     */
    protected static function createJsonRequest(Application $app) : JsonRequest
    {
        return new JsonRequest($app);
    }

    /**
     * Gets the content type of the HTTP request.
     *
     * @return string|null
     */
    protected static function contentType() : ?string
    {
        return $_SERVER['CONTENT_TYPE'] ?? null;
    }
}