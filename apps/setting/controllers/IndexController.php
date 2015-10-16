<?php

use Phalcon\Config;

namespace workManagiment\Setting\Controllers;

use workManagiment\Core\Models\Db;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        
    }

    public function settingmoduleAction() {
        $UserList = new Db\CoreMember();
        $username = $UserList::getinstance()->getusername();
        $this->view->setVar("member", $username);
    }

}
