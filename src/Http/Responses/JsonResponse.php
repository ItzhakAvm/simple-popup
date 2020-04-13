<?php

namespace Framework\Http\Responses;

use Framework\Http\Response;

class JsonResponse extends SimpleResponse
{
    public function __construct($content)
    {
        parent::__construct(json_encode($content));

        $this->setContentType('application/json');
    }
}