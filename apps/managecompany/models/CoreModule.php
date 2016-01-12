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
    
    public function addnewmodule($data){
        $this->db->query("INSERT INTO `core_module`(`module_name`, `module_id`) VALUES ('".$data['mid']."','".$data['mname']."')");
    }
    
    public function getmodulebyId($id){
       $result= $this->db->query("SELECT * FROM core_module where core_module.module_id='".$id."' ");
       $final=$result->fetchArray();
       
       return $final;
    }
    
    public function UpdateModuleById($id,$mname){
        $sql="UPDATE `core_module` SET `module_name`='".$mname."'  WHERE `module_id`='".$id."' ";
      
        $this->db->query($sql);
    }
    

}
