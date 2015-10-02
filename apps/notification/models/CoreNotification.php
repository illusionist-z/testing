<?php

namespace workManagiment\Notification\Models;


class CoreNotification  extends \Library\Core\BaseModel {
    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    public function GetNotiInfo($module_name,$noti_id){
        $result= $this->db->query("SELECT  * FROM " . $module_name . " JOIN core_member ON core_member.member_id=" . $module_name . ".member_id WHERE " . $module_name . ".noti_id='" . $noti_id . "' ");
        $final_result=$result->fetchall();
        
        return $final_result;
    }
    
    
    public function calendarnotification($id){
        $this->db->query("UPDATE core_notification SET core_notification.noti_status=1 WHERE core_notification.noti_id='" . $id . "' ");
    }
    
    public function usercalendarnotification($id,$member_id){
        $this->db->query("UPDATE core_notification_rel_member SET core_notification_rel_member.status=2 WHERE core_notification_rel_member.noti_id='" . $id . "' and core_notification_rel_member.member_id='" . $member_id . "'");
    }
}
