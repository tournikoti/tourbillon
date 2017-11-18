<?php

namespace Tourbillon\Template\Plugin;

use Tourbillon\Response\View;
use Tourbillon\Template\Plugin;

/**
 * Description of UrlPlugin
 *
 * @author gwennael
 */
abstract class UrlPlugin extends Plugin {

    public function getName() {
        return 'url';
    }

    public static function getPluginClassName(View $view) {
        return __NAMESPACE__ . "\\" . $view->getNameType() . "\\" . substr(strrchr(__CLASS__, "\\"), 1);
    }
}
