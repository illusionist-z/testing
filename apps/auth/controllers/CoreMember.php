<?php

namespace workManagiment\Auth\Controllers;
use workManagiment\Core\Models\Db\CoreMember;
use workManagiment\Auth\Models;

class CoreMember extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
    }
     
}
