<?php

namespace Tourbillon\Template\Plugin\Dwoo;

use Dwoo\Core;
use Tourbillon\Router\Router;
use Tourbillon\Template\Plugin\PathPlugin as BasePlugin;

/**
 * Description of AssetPlugin
 *
 * @author gwennael
 */
class PathPlugin extends BasePlugin {

    public function getClosure(...$args) {
        $router = $this->getRouter($args);
        return function (Core $core, $str) use ($router) {
            dump($str);
        };
    }

    /**
     * 
     * @param type $arg
     * @return Router
     */
    private function getRouter($args) {
        return $args[0];
    }
}
