<?php

namespace Tourbillon\Template\Plugin;

use Tourbillon\Response\View;
use Tourbillon\Template\Plugin;

/**
 * Description of PathPlugin
 *
 * @author gwennael
 */
abstract class PathPlugin extends Plugin {

    public function getName() {
        return 'path';
    }

    public static function getPluginClassName(View $view) {
        return __NAMESPACE__ . "\\" . $view->getNameType() . "\\" . substr(strrchr(__CLASS__, "\\"), 1);
    }
}
