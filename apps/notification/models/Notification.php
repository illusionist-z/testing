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
        
        return $final_result;
    }
    
    public function NoOfNotiforAdmin(){
      $result= $this->db->query("SELECT  * FROM notification JOIN core_member ON core_member.member_id=notification.noti_creator_id WHERE notification.noti_status=0 ");

    }
}
