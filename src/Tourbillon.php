<?php

namespace Tourbillon;

use Exception;
use ReflectionObject;
use Tourbillon\Configurator\ConfiguratorFactory;
use Tourbillon\Controller\Controller;
use Tourbillon\Response\View;
use Tourbillon\Router\Route;
use Tourbillon\ServiceContainer\ServiceLocator;
use Tourbillon\Template\FilterStore;
use Tourbillon\Template\PluginStore;

/**
 * Description of Tourbillon
 *
 * @author gjean
 */
abstract class Tourbillon
{
    protected $configPath;
    protected $mode;
    private $rootDir;

    /**
     *
     * @var ServiceLocator
     */
    protected $serviceLocator;

    /**
     * Permet de lancer l'application. Utilise dans le fichier index.php a la
     * racine
     */
    public function run()
    {
        $configurator = ConfiguratorFactory::createInstance(realpath(__DIR__.'/../config/config.neon'));
        
        $configurator->setParameters([
            'app.root_dir' => $this->getRootDir(),
            'app.var_dir' => dirname($this->getRootDir()) . '/var'
        ]);
        
        if (null !== $this->configPath) {
            $configurator->importFile($this->configPath);
        }
        
        $this->serviceLocator = new ServiceLocator($configurator, (array) $configurator->get('services'));
        $this->serviceLocator->addServices((array) $configurator->get('services'));
        $this->serviceLocator->addService('config', $configurator);

        if (!is_array($configurator->get('routing'))) {
            throw new Exception("No routes exist for your application. please see your ".$this->configPath." file");
        }

        $this->serviceLocator->get('router')->addRoutes($configurator->get('routing'));

        $this->dispatcher();
    }

    /**
     * Execute la methode du controller associe a l'URL
     */
    private function dispatcher()
    {
        $route = $this->serviceLocator->get('router')->getByRequest();

        $controller = $this->getController($route);

        $view = $this->getView($route, $controller);
        
        $this->serviceLocator->get('response')->setView($view);
        $this->serviceLocator->get('response')->render();
    }

    private function getController(Route $route)
    {
        $class = $route->getController() . 'Controller';
        if (!class_exists($class)) {
            throw new Exception("Your Controller {$class} Does not exist");
        }

        $controller = new $class($this->serviceLocator);

        if (!$controller instanceof Controller) {
            throw new Exception("Your Controller {$class} need to extend " . Controller::class);
        }
        
        return $controller;
    }

    /**
     * 
     * @param Route $route
     * @param Controller $controller
     * @return View
     * @throws Exception
     */
    private function getView(Route $route, Controller $controller)
    {
        $action = $route->getAction() . 'Action';
        if (!is_callable(array($controller, $action))) {
            throw new Exception("Method {$action}() is not defined in controller " . get_class($controller));
        }

        $view = call_user_func_array(array($controller, $action), $route->getParam());
        
        if (!$view instanceof View) {
            throw new Exception("The action {$action} of the controller " . get_class($controller) . " must return instance of " .View::class);
        }
                
        PluginStore::install($view, $this->serviceLocator);
        FilterStore::install($view, $this->serviceLocator);
        
        return $view;
    }

    /**
     *
     * @return string
     */
    public function getRootDir()
    {
        if (null === $this->rootDir) {
            $r = new ReflectionObject($this);
            $this->rootDir = dirname($r->getFileName());
        }

        return $this->rootDir;
    }

    /**
     *
     * @param string $path
     */
    public function setConfiguration($path)
    {
        $this->configPath = $path;
    }

    /**
     *
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     *
     * @param string $mode
     */
    public function getMode()
    {
        return self::$mode;
    }

}