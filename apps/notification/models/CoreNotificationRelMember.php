<?php

namespace workManagiment\Notification\Models;


class CoreNotificationRelMember  extends \Library\Core\BaseModel {
    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    public function updateNoti($noti_id){
         $this->db->query("UPDATE core_notification_rel_member set core_notification_rel_member.status=2  WHERE core_notification_rel_member.noti_id='".$noti_id."'");

    }

}
