<?php

namespace Framework\Http\Requests;

use Framework\Application;

class JsonRequest extends SimpleRequest
{
    /**
     * JsonRequest constructor.
     *
     * @param Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->loadRequestJson();
    }

    /**
     * {@inheritDoc}
     */
    protected function loadRequestJson() : void
    {
        $this->inputs = array_merge(
            $this->inputs,
            json_decode(file_get_contents('php://input'), true)
        );
    }
}