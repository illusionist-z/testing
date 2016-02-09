<?php

namespace salts\Core\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CoreMember extends \Library\Core\Models\Base {

    // Use trait for singleton
    use \Library\Core\Models\SingletonTrait;
    
    // Table name
    protected $_name = 'core_member';

    public function onConstruct() {       
        parent::onConstruct();
    }
}