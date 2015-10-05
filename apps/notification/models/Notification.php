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
    public function calendarnotification($id){
        $this->db->query("UPDATE notification SET notification.noti_status=1 WHERE notification.noti_id='" . $id . "' ");
    }
    
    public function usercalendarnotification($id,$member_id){
        $this->db->query("UPDATE notification_rel_member SET notification_rel_member.status=2 WHERE notification_rel_member.noti_id='" . $id . "' and notification_rel_member.member_id='" . $member_id . "'");
    }
}
