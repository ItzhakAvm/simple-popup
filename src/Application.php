<?php

namespace Framework;

use Composer\Autoload\ClassLoader;
use Framework\Http\Request;
use Framework\Http\RequestFactory;
use Framework\Routing\Router;

class Application
{
    /**
     * Application's base path.
     *
     * @var string
     */
    protected string $basePath;

    /**
     * Application's request instance.
     *
     * @var Request|null
     */
    protected ?Request $request = null;

    /**
     * Application's router instance.
     *
     * @var Router|null
     */
    protected ?Router $router = null;

    /**
     * Application constructor.
     *
     * @param string $basePath
     * @return void
     */
    public function __construct(string $basePath)
    {
        $this->setBasePath($basePath);

        $this->registerEssentials();

        $this->configure();
    }

    /**
     * Initializes the application.
     *
     * @return void
     */
    public function init() : void
    {
        $this->router()->execute();
    }

    /**
     * Gets the application's request instance.
     *
     * @return Request|null
     */
    public function request() : ?Request
    {
        return $this->request;
    }

    /**
     * Gets the application's router instance.
     *
     * @return Router|null
     */
    public function router() : ?Router
    {
        return $this->router;
    }

    /**
     * Gets the path to a file or folder inside the application base path.
     *
     * @param string $path
     * @return string
     */
    public function pathTo(string $path) : string
    {
        return $this->basePath . $path;
    }

    /**
     * Registers the essential services used by the application.
     *
     * @return void
     */
    protected function registerEssentials() : void
    {
        $this->setRequest($this->createRequest());
        $this->setRouter($this->createRouter());
    }

    /**
     * Loads configuration file and send parses it.
     *
     * @return void
     */
    protected function configure() : void
    {
        $this->parseConfig(require $this->pathTo('config' . DIRECTORY_SEPARATOR . 'config.php'));
    }

    /**
     * Parses the config provided for the application.
     *
     * @param array $config
     * @return void
     */
    protected function parseConfig(array $config) : void
    {
        foreach ($config as $item => $value) {
            if ($item == 'routes') {
                $this->router()->closure($value);
            }
        }
    }

    /**
     * Creates a request instance.
     *
     * @return Request
     */
    protected function createRequest() : Request
    {
        return RequestFactory::create($this);
    }

    /**
     * Creates a router instance.
     *
     * @return Router
     */
    protected function createRouter() : Router
    {
        return new Router($this);
    }

    /**
     * Sets the application path.
     * @param string $basePath
     * @return void
     */
    protected function setBasePath(string $basePath) : void
    {
        $this->basePath = rtrim($basePath, '\/') . DIRECTORY_SEPARATOR;
    }

    /**
     * Sets the application's request instance.
     *
     * @param Request $request
     * @return void
     */
    protected function setRequest(Request $request) : void
    {
        $this->request = $request;
    }

    /**
     * Sets the application's router instance.
     *
     * @param Router $router
     * @return void
     */
    protected function setRouter(Router $router) : void
    {
        $this->router = $router;
    }
}