<?php

namespace salts\Dashboard\Models;

use Phalcon\Mvc\Model;
use Library\Core\Models\Db\CoreMember;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendances extends Model {
    
      public $checkin_time;
      public $member_id;
      public $att_date;
      public $location;
      public $notes;
      public $noti_id;
      public $status;

    /**
     * set check in time when user click 'checkin'button
     * @param type $id
     * @param type $note
     * @param type $add
     * @param type $creator_id
     * @return string
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function setCheckInTime($id, $note, $add, $creator_id,$offset) {
        $this->db = $this->getDI()->getShared("db");
        $mydate = date("Y-m-d H:i:s");
        
        $today = date("Y:m:d");
        $att = Attendances::findFirst("att_date = '$today' AND member_id='$id' AND status = 1");
        /**
          Condition : Already Checked in or not
         * */
        if ($att === FALSE) {
            //$status = " Already Checked in ";
            $Noti_id = rand();
            $att_today = Attendances::findFirst("att_date = '$today' AND member_id ='$id' AND (status = 0 OR status = 3)");
            if ($att_today === FALSE) {
                $att_leave = Attendances::findFirst("att_date = '$today' AND member_id='$id' AND status = 2");
                $hour = \salts\Core\Models\Db\Attendances::getInstance()->UTCToLocal($mydate, $offset);
                $hour = date("H",strtotime($hour));
                   if ($att_leave === FALSE) {
                    $Attendances = new Attendances();
                   
                    $Attendances->checkin_time = $mydate;
                    $Attendances->member_id = $id;
                    $Attendances->att_date = $today;
                    $Attendances->location = $add;
                    $Attendances->notes = $note;
                    $Attendances->noti_id = $Noti_id;
                    $Attendances->status = ($hour > 12 ? 3 : 0 );
                    $Attendances->save();
                } else {
                    $this->db->query("UPDATE attendances set checkin_time = '" . $mydate . "',
                    location = '" . $add . "',notes = '" . $note . "',noti_id = '" . $Noti_id . "',status = ".($hour > 12 ? 3 : 0)." where att_date ='" . $today . "' AND member_id ='" . $id . "'");
                }
                if ($note != NULL) {
                    $Noti = new CoreNotification();
                    $Noti->noti_creator_id = $creator_id;
                    $Noti->module_name = 'attendances';
                    $Noti->noti_id = $Noti_id;
                    $Noti->noti_status = 0;
                    $Noti->save();
                }
                $status = " Successfully Checked In";
            } else {
                $status = "You have already check in";
            }
        } else {
            $status = "You have apply Leave for Today";
        }
        return $status;
    }

    /**
     * set check out time when user click checkout button
     * @param type $id
     * @return string
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function setCheckOutTime($id,$offset) {
        $mydate = date("Y-m-d H:i:s");
        $today = date("Y:m:d");
        $this->db = $this->getDI()->getShared("db");
        $att = Attendances::findFirst("att_date = '$today' AND member_id='$id'");
        //Check today check in or not
        if ($att != NULL) {
            $outtime = $att->checkout_time;
            //check already checkout or not
            if ($outtime != 0) {
                $status = "Already Checkout";
            } else {
                $workingHour = strtotime($mydate) - strtotime($att->checkin_time);
                if ($workingHour > 28800) {
                    $ovt = number_format((($workingHour - 28800) / 3600), 2, '.', ',');
                } else {
                    $ovt = 0;
                }
                $hour = \salts\Core\Models\Db\Attendances::getInstance()->UTCToLocal($mydate, $offset);
                $hour = date("H",strtotime($hour));
                if($hour < 12){
                      $Attendances = new Attendances();
                      $att = $Attendances::findFirst("att_date = '" . $today . "' AND member_id =  '" . $id . "'");
                      $att->status=3;
                      $att->update();
                }
                $att->checkout_time = $mydate;
                $att->overtime = $ovt;
                $att->update();
                $status = "Successfully Checked Out ";
            }
        } else {
            //check in first
            $status = "Please Check In First ";
        }
        return $status;
    }

    /**
     * @author david
     * @return array {leave name}
     * @return array {no leave name}
     * @version saw zin min tun
     */
    public function checkLeave() {
        $res = array();
        $this->db = $this->getDI()->getShared("db");
        //select where user most leave taken        
        $query = "select * from core_member "
                . "as c join absent as a on c.member_id=a.member_id "
                . "where  c.deleted_flag = 0  and a.deleted_flag = 0 group by a.member_id "
                . "order by count(*) desc limit 3";
        $data = $this->db->query($query);
        //select where no leave name in current month
         $query1 = "select * from salts\Core\Models\CoreMember as core where core.member_id not in
                   (select absent.member_id from salts\Dashboard\Models\Absent as absent where absent.date >'(NOW()-INTERVAL 2 MONTH)' and absent.deleted_flag = 0 ) and core.deleted_flag=0 order by core.created_dt desc  limit 3";
       $data1 = $this->modelsManager->executeQuery($query1);
        $res['leave_name'] = $data->fetchall();
        $res['noleave_name'] = $data1;
        return $res;
    }

    /**
     * @desc today attandance & leave list
     * @author David
     */
    public function todayAttLeave() {
        $result = array();
        $today = date('Y-m-d');
        $this->db = $this->getDI()->getShared("db");
        //today attendance list
        $query = "select count(*) as att from salts\Dashboard\Models\Attendances where att_date='$today' and (status =0 or status = 3)";
        $data = $this->modelsManager->executeQuery($query);
        $result['att'] = $data[0]['att'];
        //today leave list
        $query1 = "select count(*) as allmember from salts\Core\Models\CoreMember where deleted_flag=0";
        $data1 = $this->modelsManager->executeQuery($query1);
        $allmember = $data1[0]['allmember'];
        $result['absent'] = $allmember - $result['att'];
        return $result;
    }

    public function userAttLeave($id) {
        $currentmth = date('m');
        $result = array();
        $this->db = $this->getDI()->getShared("db");
        //today attendance list
        $query = "select count(*) as att from attendances where member_id ='$id' and (status = 0 or status = 3)and MONTH(att_date) = '$currentmth' ";
        $query = $this->db->query($query);
        $data = $query->fetchall();
        $result['att'] = $data[0]['att'];
        //today leave list
        $query1 = "select count(*) as absent from leaves where member_id = '$id' and MONTH(start_date) =  '$currentmth'";
        $query1 = $this->db->query($query1);
        $data1 = $query1->fetchall();
        $result['absent'] = $data1[0]['absent'];
        return $result;
    }

    /**
     * 
     * @param type $id
     * @return type
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function getAttList($id) {
        $currentmth = date('m');
        $this->db = $this->getDI()->getShared("db");
        $row = "Select att_date,member_login_name,checkin_time,checkout_time,"
                . "lat,lng,overtime,location from core_member left join "
                . "attendances on core_member.member_id = attendances.member_id "
                . "where MONTH(attendances.att_date) ='" . $currentmth . "' "
                . "AND attendances.member_id ='" . $id . "' "
                . "order by attendances.att_date DESC ";
        $result = $this->db->query($row);
        $list = $result->fetchall();
        return count($list);
    }

    public function getTotalLeaves($id) {
        $currentmth = date('m');
        $this->db = $this->getDI()->getShared("db");
        $row = "Select * from core_member left join leaves "
                . "on core_member.member_id = leaves.member_id "
                . "where MONTH(leaves.start_date) ='" . $currentmth . "' "
                . "AND leaves.member_id ='" . $id . "' ";
        $result = $this->db->query($row);
        $list = $result->fetchall();
        return count($list);
    }

}
