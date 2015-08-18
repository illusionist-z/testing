<?php

namespace workManagiment\Salary\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;


class CoreMemberTaxDeduce extends Model {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    
    
   

}
