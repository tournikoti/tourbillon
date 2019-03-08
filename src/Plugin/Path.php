<?php

namespace Tourbillon\Plugin;

use Tourbillon\Request\HttpRequest;

class Path
{
    private $request;
    private $router;

    public function __construct(HttpRequest $request, $router)
    {
        $this->request = $request;
        $this->router = $router;
    }

    public function get($routename, array $params = [])
    {
        return rtrim($this->request->getMainUrl(), '/') . '/' . ltrim($this->router->getByName($routename)->generate($params), '/');
    }

}
