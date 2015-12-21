<?php
namespace salts\Dashboard\Models;
use Phalcon\Mvc\Model;

/**
 * @author Yan Lin Paii
 * @desc     Core Permission Id
 */
 
class CorePermissionGroupId extends Model
{
 public $group_id;
 public $name_of_group;
    
    public function getPermitName() {
        $this->db = $this->getDI()->getShared("db");
        $sql = "Select * from core_permission_group_id";

        $data = $this->db->query($sql);
        $result=$data->fetchall();
        return $result;
    }
}
 
 
 