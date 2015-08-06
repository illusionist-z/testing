<?php

namespace workManagiment\Salary\Models;

use Phalcon\Mvc\Model;

class Allowances extends Model {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    

}
