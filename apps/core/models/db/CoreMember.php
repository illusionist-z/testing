<?php namespace workManagiment\Core\Models\Db;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class CoreMember extends \Library\Core\BaseModel{
    
    public function initialize() {
        parent::initialize();
    }
    
    public static function getInstance()
    {
        return new self();
    }
    
    
      public function getusername() {
        $this->db = $this->getDI()->getShared("db");
        $user_name = $this->db->query("SELECT * FROM core_member");
        //print_r($user_name);exit;
        $getname = $user_name->fetchall();
        return $getname;
    }
    

    public function updatetimezone($tz,$id){
     
          $this->db = $this->getDI()->getShared("db");
        
        $this->db->query("UPDATE core_member SET timezone ='".$tz."'  WHERE member_id ='".$id."' ");
        
    }
}