<?php

namespace Tourbillon\Template;

/**
 * Description of FilterStore
 *
 * @author gwennael
 */
class FilterStore {
   
    private static $instance;

    public function __construct() {
        
    }
    
    public static function install() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
    }
    
}
