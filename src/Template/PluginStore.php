<?php

namespace Tourbillon\Template;

use Tourbillon\Response\View;
use Tourbillon\Template\Plugin\AssetPlugin;

/**
 * Description of PluginStore
 *
 * @author gwennael
 */
class PluginStore {
    
    private static $instance;

    public function __construct(View $view) {
        
        new AssetPlugin();
        
        $view->addPlugin('asset', function () {
        });
    }
    
    public static function install(View $view) {
        if (null === self::$instance) {
            self::$instance = new self($view);
        }
    }
    
}
