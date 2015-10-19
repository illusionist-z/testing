<?php

namespace workManagiment\Leavedays\Models;

use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use workManagiment\Leavedays\Models\LeavesSetting;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Date;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use workManagiment\Core\Models\Db\CoreMember;
use Phalcon\Mvc\Controller;
use Phalcon\Filter;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Leaves extends \Library\Core\BaseModel {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * 
     * @param type $leave_type
     * @param type $mth
     * @param type $username
     * @return type
     */
    public function getleavelist() {
        $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*', 'leaves.*'))
                ->from(array('core' => 'workManagiment\Core\Models\Db\CoreMember'))
                ->join('workManagiment\Leavedays\Models\Leaves', 'core.member_id = leaves.member_id', 'leaves')
                ->Where('core.deleted_flag = 0')
                ->orderBy('leaves.date DESC')
                ->getQuery()
                ->execute();
        return $row;
    }

    /**
     * Search for leave list
     * @param type $ltype
     * @param type $month
     * @param type $namelist
     * @return type
     * @author zinmon
     */
    public function search($ltype, $month, $namelist) {
        $filter = new Filter();
        $ltype = $filter->sanitize($ltype, "string");
        $namelist = $filter->sanitize($namelist, "string");

        $select = "SELECT date(date) as date,member_login_name,date(start_date)"
                . "as start_date, date(end_date) as end_date,leave_days,"
                . "leave_category,leave_description,leave_status,"
                . "total_leavedays,max_leavedays FROM leaves_setting,"
                . " leaves JOIN core_member ON "
                . "leaves.member_id=core_member.member_id ";

        $conditions = array();

        if ($ltype != "") {
            $conditions[] = "leaves.leave_category='" . $ltype . "'";
        }
        if ($month != "") {
            $conditions[] = "MONTH(leaves.start_date) = '" . $month . "'";
        }
        if ($namelist != "") {
            $conditions[] = "core_member.member_login_name='" . $namelist . "'";
        }

        $sql = $select;
        if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $result = $this->db->query($sql);
        $list = $result->fetchall();
        return $list;
    }

    /**
     * Get today attendance list
     * @return type
     * @author David JP <david.gnext@gmail.com>
     */
    public function applyleave($uname, $sdate, $edate, $type, $desc, $creator_id) {
        $filter = new Filter();
        $uname = $filter->sanitize($uname, "string");
        $uname = $filter->sanitize($uname, "string");
        $type = $filter->sanitize($type, "string");
        $desc = $filter->sanitize($desc, "string");

        $this->db = $this->getDI()->getShared("db");
        $cond = array();
        $date = $this->getcontractdata($uname);

        $ldata = $this->db->query("SELECT total_leavedays FROM leaves  "
                . "WHERE leaves.member_id= '" . $uname . "' AND leaves.start_date "
                . "BETWEEN '" . $date['startDate'] . "' AND  '" . $date['endDate'] . "' ORDER BY date DESC LIMIT 1 ");
        $list = $ldata->fetchall();

        if ($list == NULL) {
            $lastdata = "0";
        } else {
            $lastdata = ($list['0']['total_leavedays']);
        }

        if (isset($sdate) AND isset($edate) AND isset($desc)) {
            $noti_id = rand();
            $today = date("Y-m-d H:i:s");
            $checkday = date("Y-m-d", strtotime("+7 days"));
            $sdate = date("Y-m-d", strtotime($sdate));
            $edate = date("Y-m-d", strtotime($edate));
            //check before a week
            if ($sdate >= $checkday && $edate >= $checkday) {
                //check $edate greater than $sdate
                if (strtotime($sdate) <= strtotime($edate)) {
                    //for calculate leave day
                    $leave_day = (strtotime($edate) - strtotime($sdate)) / 86400;
                    $result = $this->db->query("INSERT INTO leaves (member_id,date,"
                            . "start_date,end_date,leave_days,leave_category,"
                            . "leave_description,total_leavedays,leave_status,"
                            . "noti_id,created_dt) VALUES('" . $uname . "',"
                            . "'" . $today . "','" . $sdate . "',"
                            . "'" . $edate . "','" . $leave_day . "',"
                            . "'" . $type . "','" . $desc . "',"
                            . "'" . $lastdata . "',0,'" . $noti_id . "',now())");
                    $result = $this->db->query("INSERT INTO core_notification (noti_creator_id,"
                . "module_name,noti_id,noti_status) "
                . "VALUES('" . $creator_id . "','leaves','" . $noti_id . "',0)");
        $this->db->query("INSERT INTO core_notification_rel_member "
                . "(member_id,noti_id,status,module_name) "
                . "VALUES('" . $uname . "','" . $noti_id . "',0,'leaves')");
                    $cond['success'] = "Your Leave Applied Successfully!";
                } else {
                    $cond['error'] = "End date must be greater than Start date";
                }
            } else {
                $cond['error'] = "Apply Leave Before a week ";
            }
        }
        

        return $cond;
    }

    /**
     * get list of dates between two dates
     * @author Su Zin Kyaw
     * @param type $StartDate
     * @param type $EndDate
     * @return string
     */
    public function GetDays($StartDate, $EndDate) {
        $date_ffrom = $StartDate;
        $date_from = strtotime($date_ffrom); // Convert date to a UNIX timestamp  
// Specify the end date. This date can be any English textual format  
        $date_tto = $EndDate;
        $date_to = strtotime($date_tto); // Convert date to a UNIX timestamp  
// Loop from the start date to end date and output all dates inbetween  
        for ($i = $date_from; $i <= $date_to; $i+=86400) {
            $date[] = date("Y-m-d", $i) . '<br />';
        }
        return $date;
    }

    /**
     * 
     * @param type $id
     * @return type
     * get start date and end date 
     * @author Su Zin Kyaw
     */
    public function getcontractdata($id) {
        $credt = $this->db->query("SELECT working_start_dt,working_year_by_year "
                . "FROM core_member WHERE core_member.member_id= '" . $id . "'");
        $created_date = $credt->fetchall();
        if ($created_date['0']['working_year_by_year'] == '0000-00-00 00:00:00') {
            $date['startDate'] = $created_date['0']['working_start_dt'];
            $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date['0']['working_start_dt'])));
        } else {
            $date['startDate'] = $created_date['0']['working_year_by_year'];
            $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date['0']['working_year_by_year'])));
        }

        return $date;
    }

    /**
     * getting user leave list by user id,month and leave type
     * @param type $leave_type
     * @param type $mth
     * @param type $id
     * @return type
     * @author Su Zin Kyaw
     */
    public function getuserleavelist($leave_type, $mth, $id) {
        //select leave list
        $filter = new Filter();
        $leave_type = $filter->sanitize($leave_type, "string");

        $this->db = $this->getDI()->getShared("db");
        if ($leave_type == null and $mth == null) {
            $mth = date('m');
            $row = "select date,start_date,member_login_name,"
                    . "end_date,leave_category,leave_status,leave_days,"
                    . "leave_description,total_leavedays from core_member"
                    . " left join leaves on "
                    . "core_member.member_id = leaves.member_id"
                    . " where month(leaves.start_date)='" . $mth . "' "
                    . "AND leaves.member_id ='" . $id . "' order by date desc ";
        } else {
            //for searching by leave type and month           
            $row = "select date,start_date,member_login_name,end_date,"
                    . "leave_category,leave_status,leave_days,"
                    . "leave_description,total_leavedays "
                    . "from core_member left join leaves on "
                    . "core_member.member_id = leaves.member_id "
                    . "where " . $this->setCondition2($mth, $leave_type) . "  "
                    . "AND leaves.member_id ='" . $id . "'";
        }
        $result = $this->db->query($row);
        $list = $result->fetchall();
        return $list;
    }

    /**
     * set conditon for more than one condition
     * @param type $month
     * @param type $leavetype
     * @return string
     */
    public function setCondition2($month, $leavetype) {
        $conditions = array();
        $filter = new Filter();
        $leavetype = $filter->sanitize($leavetype, "string");

        if ($month != "") {

            $conditions[] = "MONTH(leaves.start_date) ='" . $month . "'";
        }
        if ($leavetype != "") {
            $conditions[] = "leaves.leave_category='" . $leavetype . "'";
        }


        if (count($conditions) > 0) {
            $result = implode(' AND ', $conditions);
        } else {
            $result = $conditions;
        }
        return $result;
    }

    /**
     * 
     * @param type $id
     * @param type $sdate
     * change leave status to '1'
     * when admin accept leavedays request from user
     * @author Su Zin kyaw
     */
    public function acceptleave($id, $days, $noti_id) {
        $this->db = $this->getDI()->getShared("db");
        $date = $this->getcontractdata($id);

        $status = 1;
        $this->db->query("UPDATE leaves set"
                . " leaves.leave_status='" . $status . "' "
                . " WHERE leaves.noti_id='" . $noti_id . "'");
        $this->db->query("UPDATE leaves set "
                . "leaves.total_leavedays=total_leavedays+'" . $days . "' "
                . "WHERE leaves.member_id='" . $id . "'  AND start_date "
                . "BETWEEN '" . $date['startDate'] . "' AND  '" . $date['endDate'] . "'");
        $this->db->query("UPDATE core_notification set"
                . " core_notification.noti_status=1  "
                . "WHERE core_notification.noti_id='" . $noti_id . "'");
        $this->db->query("UPDATE core_notification_rel_member "
                . "set core_notification_rel_member.status=1,module_name='leaves' "
                . " WHERE core_notification_rel_member.noti_id='" . $noti_id . "'");
    }

    /**
     * 
     * @param type $id
     * @param type $sdate
     * change leave status to '2'
     * when admin reject leavedays request from user
     */
    public function rejectleave($noti_id) {
        $this->db = $this->getDI()->getShared("db");
        $sql = "UPDATE leaves set leaves.leave_status=2 "
                . "WHERE leaves.noti_id='" . $noti_id . "'";
        $this->db->query("UPDATE core_notification "
                . "set core_notification.noti_status=1  "
                . "WHERE core_notification.noti_id='" . $noti_id . "'");
        $this->db->query("UPDATE core_notification_rel_member set "
                . "core_notification_rel_member.status=1,module_name='leaves'"
                . "  WHERE core_notification_rel_member.noti_id='" . $noti_id . "'");

        $this->db->query($sql);
    }

    public function getleavesetting() {
        $row = $this->modelsManager->createBuilder()
                ->columns('max_leavedays,fine_amount')
                ->from('workManagiment\Leavedays\Models\LeavesSetting')
                ->getQuery()
                ->execute();

        return $row;
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @return cond array
     * @desc   Validate Form 
     */
    public function validation($data) {
        $res = array();
        $validate = new Validation();
        $validate->add('username', new PresenceOf(
                array(
            'message' => 'Username is required'
                )
        ));
        $validate->add('sdate', new PresenceOf(
                        array(
                    'message' => 'Start Date is required'
                        )
                ))
                ->add('edate', new PresenceOf(
                        array(
                    'message' => 'End Date is required'
        )));
        $validate->add('description', new PresenceOf(
                array(
            'message' => "Reason Must be Insert"
        )));


        $messages = $validate->validate($data);
        if (count($messages)) {
            foreach ($messages as $message) {
                $res[] = $message;
            }
        }
        return $res;
    }

    public function uservalidation($data) {
        $res = array();
        $validate = new Validation();

        $validate->add('sdate', new PresenceOf(
                        array(
                    'message' => 'Start Date is required'
                        )
                ))
                ->add('edate', new PresenceOf(
                        array(
                    'message' => 'End Date is required'
        )));
        $validate->add('description', new PresenceOf(
                array(
            'message' => "Reason Must be Insert"
        )));


        $messages = $validate->validate($data);
        if (count($messages)) {
            foreach ($messages as $message) {
                $res[] = $message;
            }
        }
        return $res;
    }

}
