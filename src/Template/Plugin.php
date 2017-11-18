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
        $class = self::getPluginClassName($view);
        
        if (!class_exists($class)) {
            throw new Exception("Plugin \"$class\" does not exist");
        }
        
        return new $class();
    }
    
    protected static function getPluginClassName(View $view) {
        $namespace = substr(get_called_class(), 0, strripos(get_called_class(), "\\"));
        return $namespace . "\\" . $view->getNameType() . "\\" . substr(strrchr(get_called_class(), "\\"), 1); 
    }
    
}
