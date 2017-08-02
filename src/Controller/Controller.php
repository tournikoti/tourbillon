<?php

namespace Tourbillon\Controller;

use Tourbillon\ServiceContainer\ServiceLocator;

/**
 * Description of Controller
 *
 * @author gjean
 */
abstract class Controller
{
    protected $serviceLocator;

    public function __construct(ServiceLocator $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * 
     * @param type $path
     * @param array $params
     * @return \Tourbillon\Response\View
     */
    protected function render($path, array $params = array())
    {
        $viewConfig = $this->getConfig()->get('view');
        return $this->serviceLocator->get('view.factory')->create($viewConfig['resources'] . '/' . $path, $params, $viewConfig['template']);
    }

    /**
     * Retourne l'instance de Configurator
     * @return \Tourbillon\Configurator\Configurator
     */
    protected function getConfig()
    {
        return $this->serviceLocator->get('config');
    }
}
