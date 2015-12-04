<?php

namespace Library\Core;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class BaseModel extends \Phalcon\Mvc\Model {
    public $db;
    
    public function initialize(){
        
    }

    public function onConstruct() {
        $this->db = $this->getDI()->getShared("db");
    }

}
