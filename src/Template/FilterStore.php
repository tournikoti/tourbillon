<?php

namespace Tourbillon\Template;

use Tourbillon\Response\View;
use Tourbillon\ServiceContainer\ServiceLocator;

/**
 * Description of FilterStore
 *
 * @author gwennael
 */
class FilterStore {
   
    private static $instance;

    public function __construct() {
        
    }
    
    public static function install(View $view, ServiceLocator $serviceLocator) {
        if (null === self::$instance) {
            self::$instance = new self();
        }
    }
    
}
