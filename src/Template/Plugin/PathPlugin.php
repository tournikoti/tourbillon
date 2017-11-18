<?php

namespace Tourbillon\Template\Plugin;

use Tourbillon\Response\View;
use Tourbillon\Template\Plugin;

/**
 * Description of PathPlugin
 *
 * @author gwennael
 */
abstract class PathPlugin extends Plugin {

    public function getName() {
        return 'path';
    }

}
