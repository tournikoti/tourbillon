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
    
    protected function render($path, array $params = array())
    {
        
    }
}
