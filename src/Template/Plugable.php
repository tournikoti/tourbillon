<?php

namespace Tourbillon\Template;

/**
 * Description of Plugin
 *
 * @author gwennael
 */
interface Plugable {

    public function getName();
    
    public function getClosure(...$args);
}
