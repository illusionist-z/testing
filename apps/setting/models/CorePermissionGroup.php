<?php
namespace salts\Setting\Models;
use Phalcon\Mvc\Model;
/**
 * @author Yan Lin Pai  <> <wizardrider@gmail.com>
 * @desc     CorePermissionGroup
 */
 class CorePermissionGroup extends Model
{ 
     public function initialize(){
       $this->db = $this->getDI()->getShared('db');  
     }

     public function corepermissionUpdate($idpage,$page_rule,$p_code){         
         $success=$this->db->execute("UPDATE core_permission_group SET page_rule_group='".$page_rule
                 ."' , permission_code ='". $p_code ."' WHERE idpage='$idpage'");
         return $success;
     }
 
}
 
 
 
 
