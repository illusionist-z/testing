<?php

namespace workManagiment\Core\Models\Db;

        use Phalcon\Filter; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendances extends \Library\Core\BaseModel {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public static function getInstance() {
        return new self();
    }

    

}
