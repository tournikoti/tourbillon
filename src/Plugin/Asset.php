<?php

namespace Tourbillon\Plugin;

use Tourbillon\Request\HttpRequest;

class Asset
{
    private $request;

    public function __construct(HttpRequest $request)
    {
        $this->request = $request;
    }

    public function get($path)
    {
        return rtrim($this->request->getMainUrl(), "/") . "/" . $path;
    }

}