<?php

namespace Tourbillon\Provider;

use Tourbillon\Configurator\Configurator;
use Tourbillon\Request\HttpRequest;
use Tourbillon\Router\Router;
use Tourbillon\ServiceContainer\ServiceProvider;

/**
 * Description of Router
 *
 * @author gjean
 */
class RouterProvider extends ServiceProvider
{
    private $configurator;
    private $router;

    public function configuration(Configurator $configurator)
    {
        $this->configurator = $configurator;
    }

    public function createInstance(HttpRequest $request)
    {
        if (null === $this->router) {
            $this->router = new Router($request, $this->configurator->get('routing'));
        }
        return $this->router;
    }

}