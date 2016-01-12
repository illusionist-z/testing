<?php

namespace salts\Managecompany\Models;
use Phalcon\Mvc\Model;

class CoreModule extends \Library\Core\BaseModel {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    public function getallmodule(){
        $result= $this->db->query("select * from core_module");
        $final=$result->fetchall();
       return $final;
    }
    

}
