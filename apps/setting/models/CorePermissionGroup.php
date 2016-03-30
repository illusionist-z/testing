<?php

namespace salts\Setting\Models;

use Phalcon\Mvc\Model; 
/**
 * @author Yan Lin Pai  <> <wizardrider@gmail.com>
 * @desc     CorePermissionGroup
 */
class CorePermissionGroup extends Model {

    public $idpage;
    public $page_rule_group;
    public $permission_code;
    public $permission_group_code;  
    public $permission_group_name;

 


//    public function corePermissionUpdate($idpage, $page_rule, $p_code) {
//        $success = $this->db->execute("UPDATE core_permission_group SET page_rule_group='" . $page_rule
//                . "' , permission_code ='" . $p_code . "' WHERE idpage='$idpage'");
//        return $success;
//    }

}
