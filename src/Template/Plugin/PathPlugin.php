<?php

namespace Tourbillon\Template\Plugin;

use Tourbillon\Response\View;
use Tourbillon\Template\Plugin;

/**
 * Description of PathPlugin
 *
 * @author gwennael
 */
abstract class PathPlugin implements Plugin {

    public function getName() {
        return 'path';
    }

    public static function get(View $view) {
        $class = __NAMESPACE__ . "\\" . $view->getNameType() . "\\" . substr(strrchr(__CLASS__, "\\"), 1);
        
        if (!class_exists($class)) {
            throw new Exception("Plugin \"$class\" does not exist");
        }
        
        return new $class();
    }
}
