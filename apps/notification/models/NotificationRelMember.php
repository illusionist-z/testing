<?php

namespace workManagiment\Notification\Models;


class NotificationRelMember  extends \Library\Core\BaseModel {
    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    public function updateNoti($noti_id){
         $this->db->query("UPDATE notification_rel_member set notification_rel_member.status=2  WHERE notification_rel_member.noti_id='".$noti_id."'");

    }

}
