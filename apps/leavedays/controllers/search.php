<?php

use Phalcon\Config;

namespace workManagiment\Leavedays\Controllers;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
         echo "search";exit;
    }
  
}
