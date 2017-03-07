<?php

namespace Tourbillon;

use Tourbillon\Configurator\ConfiguratorFactory;
use Tourbillon\ServiceContainer\ServiceLocator;

/**
 * Description of Tourbillon
 *
 * @author gjean
 */
class Tourbillon
{
    protected $configPath;
    protected $mode;

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
        $configurator = ConfiguratorFactory::createInstance($this->configPath);
        $this->serviceLocator = new ServiceLocator((array) $configurator->get('services'));
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
