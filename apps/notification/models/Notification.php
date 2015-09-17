<?php

namespace workManagiment\Notification\Models;


class Notification  extends \Library\Core\BaseModel {
    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    public function GetNotiInfo($module_name,$noti_id){
        $result= $this->db->query("SELECT  * FROM " . $module_name . " JOIN core_member ON core_member.member_id=" . $module_name . ".member_id WHERE " . $module_name . ".noti_id='" . $noti_id . "' ");
        $final_result=$result->fetchall();
        $final_result['module_name']=$module_name;
        //print_r($final_result);exit;
        return $final_result;
    }
}
