<?php

namespace Tourbillon\Template;

/**
 * Description of Plugin
 *
 * @author gwennael
 */
interface Plugin {

    public function getName();
    
    public function getClosure(...$args);
}
