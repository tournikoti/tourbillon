<?php

namespace Tourbillon\Template\Plugin;

use Tourbillon\Response\View;
use Tourbillon\Template\Plugin;

/**
 * Description of AssetPlugin
 *
 * @author gwennael
 */
abstract class AssetPlugin extends Plugin {

    public function getName() {
        return 'asset';
    }

    public static function getPluginClassName(View $view) {
        return __NAMESPACE__ . "\\" . $view->getNameType() . "\\" . substr(strrchr(__CLASS__, "\\"), 1);
    }
}
