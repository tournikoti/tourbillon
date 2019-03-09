<?php

namespace Tourbillon\Controller;

use Tourbillon\Request\HttpRequest;
use Tourbillon\Response\View;
use Tourbillon\ServiceContainer\ServiceContainerAwareInterface;
use Tourbillon\ServiceContainer\ServiceLocator;
use Tourbillon\Template\Twig\Extension;

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

        $this->addPlugin($view);

        return $view;
    }

    private function addPlugin(View $view)
    {
        $extensionClass = 'Tourbillon\\Template\\' . $view->getNameType() . '\\Extension';

        if (class_exists($extensionClass)) {
            $extension = new $extensionClass();

            if ($extension instanceof ServiceContainerAwareInterface) {
                $extension->setServiceLocator($this->serviceLocator);
            }

            $view->addPlugin($extension);
        }
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

    /**
     * @return HttpRequest
     * @throws \Exception
     */
    protected function getRequest()
    {
        return $this->serviceLocator->get('request');
    }
}
