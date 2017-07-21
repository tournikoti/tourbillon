<?php

namespace Tourbillon\Template\Plugin;

use Tourbillon\Template\Plugin;

/**
 * Description of AssetPlugin
 *
 * @author gwennael
 */
class AssetPlugin implements Plugin {
    
    public function __invoke() {
        dump("BOOM"); exit;
    }
    
}
