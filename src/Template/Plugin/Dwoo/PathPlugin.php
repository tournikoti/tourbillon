<?php

namespace Tourbillon\Template\Plugin\Dwoo;

use Dwoo\Core;
use Tourbillon\Request\HttpRequest;
use Tourbillon\Router\Router;
use Tourbillon\Template\Plugin\PathPlugin as BasePlugin;

/**
 * Description of AssetPlugin
 *
 * @author gwennael
 */
class PathPlugin extends BasePlugin {

    public function getClosure(...$args) {
        $request = $this->getRequest($args);
        $router = $this->getRouter($args);
        return function (Core $core, $str, $params = array()) use ($request, $router) {
            return rtrim($request->getMainUrl(), '/') . '/' . ltrim($router->getByName($str)->generate($params), '/');
        };
    }

    /**
     * 
     * @param type $arg
     * @return HttpRequest
     */
    private function getRequest($args) {
        return $args[0];
    }
    
    /**
     * 
     * @param type $arg
     * @return Router
     */
    private function getRouter($args) {
        return $args[1];
    }
}
