<?php

use Phalcon\Setting\Model;

class Users extends Model
{
      
        public function setting(){
        
        $this->db = $this->getDI()->getShared("db");
        $core_permission_group_name = $this->db->query("SELECT * FROM `core_permission_group_id` ORDER BY `group_id` ASC");
        $core_permission_group_name = $core_permission_group_name->fetchall();
        return $core_permission_group_name;
    }

}