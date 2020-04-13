<?php

namespace Framework\Http\Responses;

use Framework\Http\Response;
use Framework\Templating\View;

class ViewResponse extends Response
{
    /**
     * View params.
     *
     * @var array
     */
    protected array $params = [];

    /**
     * ViewResponse constructor.
     *
     * @param $content
     * @param array $params
     * @return void
     */
    public function __construct($content, array $params = [])
    {
        parent::__construct($content);

        $this->params = $params;
    }

    /**
     * {@inheritDoc}
     */
    protected function render(): void
    {
        $this->createView($this->content(), $this->params)
            ->render();
    }

    /**
     * Creates a new view instance with the provided path.
     *
     * @param string $path
     * @param array $params
     * @return View
     */
    protected function createView(string $path, array $params) : View
    {
        return (new View($path, $params))
            ->setApplication($this->app);
    }
}