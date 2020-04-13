<?php

namespace Framework\Http\Responses;

use Framework\Http\Response;

class SimpleResponse extends Response
{
    /**
     * {@inheritDoc}
     */
    protected function render() : void
    {
        echo $this->content();
    }
}