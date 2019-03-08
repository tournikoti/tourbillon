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
        $view = $this->serviceLocator->get('view.factory')->create($viewConfig['resources'], $path, $params, $viewConfig['template']);
        
        $view->setConfig([
            'template_path' => $this->getConfig()->getParameter('app.root_dir') . '/views',
            'compile_path' => $this->getConfig()->getParameter('app.var_dir') . '/views/cache',
        ]);

        return $view;
    }

    /**
     * Retourne l'instance de Configurator
     * @return \Tourbillon\Configurator\Configurator
     */
    protected function getConfig()
    {
        return $this->serviceLocator->get('config');
    }
    
    /**
     * 
     * @param type $name
     * @return \Tourbillon\Dbal\Connection
     */
    protected function getConnection($name = 'default')
    {
        return $this->serviceLocator->get('dbal')->getConnection($name);
    }
}
