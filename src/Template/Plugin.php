<?php

namespace Tourbillon\Template;

use Exception;
use Tourbillon\Response\View;

/**
 * Description of Plugin
 *
 * @author oem
 */
abstract class Plugin implements Plugable {
    
    public static function get(View $view) {
        $class = $this->getPluginClassName($view);
        
        if (!class_exists($class)) {
            throw new Exception("Plugin \"$class\" does not exist");
        }
        
        return new $class();
    }
    
    protected abstract function getPluginClassName(View $view);
    
}
