<?php

namespace salts\Core\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CorePermissionRelMember extends \Library\Core\BaseModel {

    // Use trait for singleton
    use \Library\Core\Models\SingletonTrait;

    public function initialize() {
        parent::initialize();
    }

}
