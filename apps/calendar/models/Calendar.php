<?php

namespace salts\Calendar\Models;

use Phalcon\Mvc\Model;

/**
 * @author David
 * @since 27/7/2015
 * @desc  To create,edit,delete event
 */
class Calendar extends Model {

    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * @return array {calendar event data}
     * @author David
     * @desc   Select all data 
     */
    public function fetch($id) {
        $events = array();
        $d = date("Y-m-d");
        $today = date("Y-m-d", strtotime($d));
        if (is_array($id)) {
            $member_id = implode($id, "','");
            $sql = "SELECT * FROM calendar where member_name IN ('$member_id')";
        } else {
            $sql = "SELECT * FROM calendar where id IN ('$id') or member_name IN ('$id')";
        }
        $query = $this->db->query($sql);
        $query->setFetchMode(\Phalcon\Db::FETCH_ASSOC);

        while ($fetch = $query->fetchArray()) {
            $e = array();
            $e['id'] = $fetch['id'];
            $e['member_name'] = $fetch['member_name'];
            $e['title'] = $fetch['title'];
            $e['start'] = $fetch['startdate'];
            $s = $fetch['enddate'];
            $e['end'] = date('Y-m-d H:i:s', strtotime($s . '+1 days'));
            ($today > date("Y-m-d", strtotime($fetch['enddate']))) ? $e['color'] = '#aaa' : $e['color'] = '#3a87ad';
            $allday = ($fetch['allDay'] == "true") ? true : false;
            $e['allDay'] = $allday;
            array_push($events, $e);
        }
        return $events;
    }

    /**
     * @desc create new event by click on calendar
     * @author David
     * @version Su Zin Kyaw
     */
    public function createEvent($member_id, $creator_name, $creator_id, $sdate, $edate, $title, $uname) {
        $noti_id = rand();
        $this->db = $this->getDI()->getShared("db");
        $insert = "INSERT INTO calendar (member_id,member_name,title,startdate,enddate,allDay,noti_id,creator_id,created_dt) Values ('" . $member_id . "','" . $uname . "','" . $title . "','" . $sdate . "','" . $edate . "','true','" . $noti_id . "','" . $creator_id . "',now())";
        $query = $this->db->query($insert);
        $admins = $this->db->query("SELECT * FROM core_member join core_permission_rel_member on core_permission_rel_member.rel_member_id=core_member.member_id where core_member.member_id != '" . $creator_id . "' ");
        $admins = $admins->fetchall();
        foreach ($admins as $admins) {
            $this->db->query("INSERT INTO core_notification (creator_name,noti_creator_id,module_name,noti_id,noti_status) VALUES('" . $creator_name . "','" . $admins['member_id'] . "','calendar','" . $noti_id . "',0)");
        }
        $users = $this->db->query("SELECT * FROM core_member join core_permission_rel_member on core_permission_rel_member.rel_member_id=core_member.member_id where core_permission_rel_member.rel_permission_group_code='USER' and core_member.member_id != '" . $creator_id . "' ");
        $users = $users->fetchall();
        foreach ($users as $users) {
            $this->db->query("INSERT INTO core_notification_rel_member (creator_name,member_id,noti_id,status,module_name) VALUES('" . $creator_name . "','" . $users['member_id'] . "','" . $noti_id . "',1,'calendar')");
        }
        return $query;
    }

    /**
     * @desc   edit event
     * @author David
     */
    public function editEvent($name, $sdate, $edate, $title, $id, $member_id) {
        $this->db = $this->getDI()->getShared("db");
        $update = "UPDATE calendar SET member_name ='" . $name . "',title ='" . mysql_real_escape_string($title) . "',startdate='" . $sdate . "',enddate='" . $edate . "',member_id ='" . $member_id . "' WHERE id='" . $id . "'";
        $query = $this->db->query($update);
        return $query;
    }

    public function getIdName($id) {
        $this->db = $this->getDI()->getShared("db");
        $getname = "Select member_name from calendar where id='" . $id . "'";
        $query = $this->db->query($getname);
        $result = $query->fetchall();
        return $result;
    }

    /**
     * @since 27/7/15
     * @author David
     */
    public function deleteEvent($id) {
        $this->db = $this->getDI()->getShared("db");
        $delete = "DELETE FROM calendar WHERE id='" . $id . "'";
        $query = $this->db->query($delete);
    }

    public function removeMember($remove_id, $id) {
        $remove_id = implode("','", $remove_id);
        $query = "update member_event_permission set delete_flag =1 where permit_name in ('$remove_id') and member_name = '" . $id . "'";
        $this->db->query($query);
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @param type $permit_name
     * @param type $id    
     * @desc    event permit action
     */
    public function addPermitName($permit_name, $id) {
        $query = "Select * from member_event_permission where permit_name ='" . $permit_name . "' and member_name = '" . $id . "' ";

        $result = $this->db->query($query);
        if ($result->numRows() == 0) {
            $query1 = "Insert into member_event_permission (member_name,permit_name,delete_flag) Values ('$id','" . $permit_name . "',0)";

            $this->db->query($query1);
            $return = 0;
        } else {
            $query2 = "Select * from member_event_permission where permit_name ='" . $permit_name . "' and member_name = '" . $id . "' and delete_flag=1";
            $result2 = $this->db->query($query2);
            if ($result2->numRows() == 0) {
                $return = 1;
            } else {
                $query3 = "update member_event_permission set delete_flag = 0 where permit_name = '" . $permit_name . "' and member_name = '" . $id . "'";
                $this->db->query($query3);
                $return = 0;
            }
        }
        return $return;
    }

    public function getalluser($id) {
        $query = "Select member_name,permit_name from member_event_permission where member_name ='" . $id . "' and delete_flag=0";
        $result = $this->db->query($query);
        $data = $result->fetchall();
        return $data;
    }

    /**
     *
     *  type get $member_id
     * @author Saw Zin Min Tun
     */
    public function memIdCal($uname) {
        $sql = "select * from core_member WHERE full_name ='" . $uname . "'";
        $result = $this->db->query($sql);
        $row = $result->fetchall();
        return $row;
    }

}
