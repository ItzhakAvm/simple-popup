<?php

namespace Framework\Templating;

use Framework\Application;

class View
{
    /**
     * Application instance.
     *
     * @var Application
     */
    protected ?Application $app = null;

    /**
     * View path.
     *
     * @var string
     */
    protected string $path;

    /**
     * View params.
     *
     * @var array
     */
    protected array $params;

    /**
     * View constructor.
     *
     * @param string $path
     * @param array $params
     * @return void
     */
    public function __construct(string $path, array $params = [])
    {
        $this->path = $path;
        $this->params = $params;
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
     * Renders the view.
     *
     * @return void
     */
    public function render() : void
    {
        $path = $this->app->pathTo('views' . DIRECTORY_SEPARATOR . $this->path . '.php');

        if (! is_file($path)) {
            throw new \LogicException(
                "View not found in `{$path}"
            );
        }

        extract($this->params);

        require $path;
    }
}