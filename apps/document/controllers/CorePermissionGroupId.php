<?php

namespace workManagiment\Dashboard\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use workManagiment\Dashboard\Models\CorePermissionGroupId;
use Phalcon\Mvc\Controller;
use Phalcon\Filter;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CorePermissionGroupId extends \Library\Core\BaseModel {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

  
      

}
