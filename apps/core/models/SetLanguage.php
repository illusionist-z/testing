<?php

namespace workManagiment\Core\Models;          
 use Phalcon\Mvc\Model;
 use Phalcon\Mvc\Controller;
 use workManagiment\Core\Models\SetLanguage;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SetLanguage extends \Library\Core\BaseModel {    
    
    public function initialize() {        
        parent::initialize();        
    }

    public static function getInstance() {
        return new self();
    }
    
    public function settinglanguage($language,$member) {        
        $this->db = $this->getDI()->getShared("db");
        $query = "update core_member set lang = '".$language."' where member_id='$member'";
        $this->db->query($query);
    }         
}
