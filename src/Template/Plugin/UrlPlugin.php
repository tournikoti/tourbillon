<?php

namespace Tourbillon\Template\Plugin;

use Tourbillon\Response\View;
use Tourbillon\Template\Plugin;

/**
 * Description of UrlPlugin
 *
 * @author gwennael
 */
abstract class UrlPlugin extends Plugin {

    public function getName() {
        return 'url';
    }

}
