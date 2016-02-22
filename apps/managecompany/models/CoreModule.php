<?php

namespace salts\Managecompany\Models;

use Phalcon\Mvc\Model;

class CoreModule extends Model {

    public $module_id;
    public $module_name;

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
       public function getAllmodule() {
        $result = $this->db->query("select * from core_module");
        $final = $result->fetchall();
        return $final;
    }


    public function updateModuleById($id, $mname) {
        $sql = "UPDATE `core_module` SET `module_name`='" . $mname . "'  WHERE `module_id`='" . $id . "' ";
        $this->db->query($sql);
    }

}
