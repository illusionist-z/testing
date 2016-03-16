<?php

namespace salts\Notification\Models;


class CoreNotificationRelMember extends \Phalcon\Mvc\Model {

    public $noti_id;
    public $status;
public function updateNoti($noti_id){
        $this->db = $this->getDI()->getShared("db");
        $this->db->query("UPDATE core_notification_rel_member set core_notification_rel_member.status=2  WHERE core_notification_rel_member.noti_id='".$noti_id."'");

    }
}

