<?php

namespace salts\Dashboard\Models;

use Phalcon\Mvc\Model;

date_default_timezone_set("UTC");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendances extends Model {

    /**
     * set check in time when user click 'checkin'button
     * @param type $id
     * @param type $note
     * @param type $add
     * @param type $creator_id
     * @return string
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function setCheckInTime($id, $note, $add, $creator_id) {
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
            $att_today = Attendances::findFirst("att_date = '$today' AND member_id ='$id' AND status = 0");
            if ($att_today === FALSE) {
                $att_leave = Attendances::findFirst("att_date = '$today' AND member_id='$id' AND status = 2");
                if ($att_leave === FALSE) {
                    $this->db->query("INSERT INTO attendances (checkin_time,member_id,"
                            . "att_date,location,notes,noti_id,status) VALUES ('" . $mydate . "'"
                            . ",'" . $id . "','" . $today . "',
                    '" . $add . "','" . $note . "','" . $Noti_id . "',0)");
                } else {
                    $this->db->query("UPDATE attendances set checkin_time = '" . $mydate . "',
                    location = '" . $add . "',notes = '" . $note . "',noti_id = '" . $Noti_id . "',status = 0 where att_date ='" . $today . "' AND member_id ='" . $id . "'");
                }
                if ($note != NULL) {
                    $this->db->query("INSERT INTO core_notification (noti_creator_id,"
                            . "module_name,noti_id,noti_status) "
                            . "VALUES('" . $creator_id . "','attendances','" . $Noti_id . "',0)");
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
    public function setCheckOutTime($id) {
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
                $this->db->query("UPDATE attendances SET "
                        . "checkout_time='" . $mydate . "',overtime='" . $ovt . "' "
                        . "WHERE att_date='" . $today . "' AND member_id='" . $id . "'");
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
        $query1 = "select * from core_member where member_id not in
                   (select member_id from absent where date >(NOW()-INTERVAL 2 MONTH) and deleted_flag = 0 ) and deleted_flag=0 order by created_dt desc  limit 3";
        $data1 = $this->db->query($query1);
        $res['leave_name'] = $data->fetchall();
        $res['noleave_name'] = $data1->fetchall();
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
        $query = "select count(*) as att from attendances where att_date='$today' and status =0";
        $query = $this->db->query($query);
        $data = $query->fetchall();
        $result['att'] = $data[0]['att'];
        //today leave list
        $query1 = "select count(*) as allmember from core_member where deleted_flag=0";
        $query1 = $this->db->query($query1);
        $data1 = $query1->fetchall();
        $allmember = $data1[0]['allmember'];
        $result['absent'] = $allmember - $result['att'];
        return $result;
    }

    public function userAttLeave($id) {
        $currentmth = date('m');
        $result = array();
        $this->db = $this->getDI()->getShared("db");
        //today attendance list
        $query = "select count(*) as att from attendances where member_id ='$id' and status = 0 and MONTH(att_date) = '$currentmth' ";
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
