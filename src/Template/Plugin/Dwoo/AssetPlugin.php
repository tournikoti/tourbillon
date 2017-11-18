<?php

namespace Tourbillon\Template\Plugin\Dwoo;

use Dwoo\Core;
use Tourbillon\Request\HttpRequest;
use Tourbillon\Template\Plugin\AssetPlugin as BasePlugin;

/**
 * Description of AssetPlugin
 *
 * @author gwennael
 */
class AssetPlugin extends BasePlugin {

    public function getClosure(...$args) {
        $request = $this->getRequest($args);
        return function (Core $core, $str) use ($request) {
            return rtrim($request->getBaseUrl(), "/") . "/" . $str;
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
}
