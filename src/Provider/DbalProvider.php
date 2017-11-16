<?php

namespace Tourbillon\Provider;

use Tourbillon\Configurator\Configurator;
use Tourbillon\Dbal\ConnectionFactory;
use Tourbillon\ServiceContainer\ServiceProvider;

/**
 * Description of DbalProvider
 *
 * @author gjean
 */
class DbalProvider extends ServiceProvider {

    private $configurator;
    private $connectionFactory;

    public function configuration(Configurator $configurator) {
        $this->configurator = $configurator;
    }

    public function createInstance()
    {
        if (null === $this->connectionFactory) {
            $this->connectionFactory = new ConnectionFactory($this->configurator->get('database'));
        }
        return $this->connectionFactory;
    }
}
