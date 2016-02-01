<?php

namespace salts\Auth\Controllers;

use salts\Core\Models\Db\CoreMember;
use salts\Auth\Models;

class CoreMember extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
    }

}
