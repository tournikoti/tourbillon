<?php

namespace Tourbillon\Template;

use Tourbillon\Response\View;
use Tourbillon\ServiceContainer\ServiceLocator;
use Tourbillon\Template\Plugin\AssetPlugin;

/**
 * Description of PluginStore
 *
 * @author gwennael
 */
class PluginStore {
    
    /**
     *
     * @var ServiceLocator
     */
    private $serviceLocator;
    
    private static $instance;

    public function __construct(View $view, ServiceLocator $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        $this->addPlugin($view, AssetPlugin::get($view));
    }
    
    public static function install(View $view, ServiceLocator $serviceLocator) {
        if (null === self::$instance) {
            self::$instance = new self($view, $serviceLocator);
        }
    }
    
    protected function addPlugin(View $view, Plugin $plugin) {
        $view->addPlugin($plugin->getName(), $plugin->getClosure($this->serviceLocator->get('request')));
    }

}
