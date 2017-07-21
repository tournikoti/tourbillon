<?php

namespace Tourbillon\Template\Plugin\Dwoo;

use Dwoo\Core;
use Tourbillon\Request\HttpRequest;
use Tourbillon\Template\Plugin\AssetPlugin as BaseAssetPlugin;

/**
 * Description of AssetPlugin
 *
 * @author gwennael
 */
class AssetPlugin extends BaseAssetPlugin {

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
