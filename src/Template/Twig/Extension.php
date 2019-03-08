<?php

namespace Tourbillon\Template\Twig;

use Tourbillon\Response\View\ExtensionInterface;
use Tourbillon\Response\View\Twig\Twig;
use Tourbillon\ServiceContainer\ServiceContainerAwareInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Extension extends AbstractExtension implements ExtensionInterface, ServiceContainerAwareInterface
{
    private $serviceLocator;

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }


    public function getFunctions()
    {
        return [
            new TwigFunction('asset', [$this->serviceLocator->get('view.extension.asset'), 'get']),
            new TwigFunction('path', [$this->serviceLocator->get('view.extension.path'), 'get']),
            new TwigFunction('url', [$this->serviceLocator->get('view.extension.url'), 'get']),
        ];
    }
}