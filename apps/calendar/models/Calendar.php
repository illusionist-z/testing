<?php

namespace salts\Calendar\Models;
 
use Phalcon\Filter;

use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\Model;
/**
 * @author David
 * @since 27/7/2015
 * @desc  To create,edit,delete event
 */
class Calendar extends Model {

    public $filter;    
    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
        $this->filter = new Filter();        
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
            $e['end'] = date('Y-m-d', strtotime($s . '+1 days'));
            ($today > date("Y-m-d", strtotime($fetch['enddate']))) ? $e['color'] = '#aaa' : $e['color'] = '#3a87ad';
            $allday = ($fetch['allDay'] == true) ? true : false;
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
        //calendar save ()
        $calendar = new Calendar();
        $calendar->member_id = $this->filter->sanitize($member_id,"string");
        $calendar->member_name = $this->filter->sanitize($uname,"string");
        $calendar->title  = $this->filter->sanitize($title,"string");
        $calendar->startdate = $sdate;
        $calendar->enddate = $edate;
        $calendar->allDay = true;
        $calendar->noti_id = $noti_id;
        $calendar->creator_id = $this->filter->sanitize($creator_id,"string");
        $calendar->created_dt = date("Y-m-d H:i:s");
        $calendar->save();
        //$admins = "SELECT * FROM core_member join core_permission_rel_member on core_permission_rel_member.rel_member_id=core_member.member_id where core_member.member_id != '" . $creator_id . "' ";
        $admins = $this->modelsManager->createBuilder()
                     ->columns(array('core.*', 'rel_member.*'))
                     ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Core\Models\CorePermissionRelMember', 'core.member_id = rel_member.rel_member_id', 'rel_member')
                    ->where('core.member_id != :id:', array('id' => $creator_id))
                    ->getQuery()->execute();
        foreach ($admins as $admins) {
            $notification = new \salts\Core\Models\Db\CoreNotification();
            $notification->creator_name = $this->filter->sanitize($creator_name,"string");
            $notification->noti_creator_id = $this->filter->sanitize($admins->core->member_id,"string");
            $notification->module_name = $this->filter->sanitize("calendar","string");
            $notification->noti_id = $this->filter->sanitize($noti_id,"int");
            $notification->noti_status = 0;
            $notification->save();
        }        
        $users = $this->modelsManager->createBuilder()
                    ->columns(array('core.*', 'rel_member.*'))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Core\Models\CorePermissionRelMember', 'core.member_id = rel_member.rel_member_id', 'rel_member')
                    ->where('core.member_id != :id:', array('id' => $creator_id))
                    ->andWhere('rel_member.rel_permission_group_code ="USER"')
                    ->getQuery()->execute();        
        foreach ($users as $users) {
            $NotiRelMember = new \salts\Core\Models\Db\CoreNotificationRelMember();
            $NotiRelMember->creator_name = $creator_name;
            $NotiRelMember->member_id    = $this->filter->sanitize($users->core->member_id,"string");
            $NotiRelMember->noti_id           = $this->filter->sanitize($noti_id,"int");
            $NotiRelMember->status            = 1;
            $NotiRelMember->module_name = $this->filter->sanitize("calendar","string");
            $NotiRelMember->save();
        }        
    }

    /**
     * @desc   edit event
     * @author David
     */
    public function editEvent($name, $sdate, $edate, $title, $id, $member_id) {
        $edit = Calendar::findFirst("id ='$id'");
        $edit->member_name = $this->filter->sanitize($name,"string");
        $edit->title   = $this->filter->sanitize($title,"string");
        $edit->startdate = $sdate;
        $edit->enddate  = $edate;
        $edit->member_id = $this->filter->sanitize($member_id,"string");
        $edit->update();
        return $edit;
    }

    public function getIdName($id) {
        $getname = Calendar::find("id ='$id'");
        $data = $getname->toArray();
        return $data;
    }

    /**
     * @since 27/7/15
     * @author David
     */
    public function deleteEvent($id) {
        $this->db = $this->getDI()->getShared("db");
        $delete = Calendar::findFirst("id ='$id'");
        $delete->delete();
    }

    public function removeMember($remove_id, $id) {
        foreach($remove_id as $remove){
        $query = MemberEventPermission::findFirst("permit_name ='$remove' and member_name ='$id'");
        $query->delete_flag = 1;
        $query->update();
        }
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @param type $permit_name
     * @param type $id    
     * @desc    event permit action
     */
    public function addPermitName($permit_name, $id) {
        $permit = new MemberEventPermission();
        $query = MemberEventPermission::find("permit_name ='$permit_name' and member_name = '$id' ");
        if($query == false || count($query) == 0 ){
        $permit->member_name = $id;
        $permit->permit_name    = $permit_name;
        $permit->delete_flag  = 0;
        $permit->save();
        $return = 0;
        }
        else  {
            $add_permit = \salts\Core\Models\Permission::tableObject($query);
            if($add_permit->delete_flag == 0 )   {$return = 1;}
            else {
                $add_permit->delete_flag = 0;
                $add_permit->update();
                $return = 0;
            }
        } 
        return $return;
    }

    public function getalluser($id) {
        $AllUser = MemberEventPermission::find("member_name ='$id' and delete_flag = 0");        
        $data = $AllUser->toArray();
        return $data;
    }

    /**
     *
     *  type get $member_id
     * @author Saw Zin Min Tun
     */
    public function memIdCal($uname) {
        $core_member = \salts\Core\Models\Db\CoreMember::find("member_login_name ='$uname'");
        $row = $core_member->toArray();
        return $row;
    }

}
