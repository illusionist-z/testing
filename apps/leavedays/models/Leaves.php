<?php

namespace salts\Leavedays\Models;
 date_default_timezone_set('UTC');
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use salts\Core\Models\Db\CoreMember;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Filter;
date_default_timezone_set('UTC');
use Phalcon\Mvc\Model\Query;
class Leaves extends \Library\Core\Models\Base {

    public $base;
    

    public function initialize() {
        parent::initialize();
        $this->base = new\Library\Core\Models\Base();
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * 
     * @param type $leave_type
     * @param type $mth
     * @param type $username
     * @return type
     */
    public function getLeaveList($currentPage) {
        $mth = date('m');
        $row = $this->modelsManager->createBuilder()
                ->columns(array('core_member.*', 'leaves.*'))
                ->from(array('core_member' => 'salts\Core\Models\Db\CoreMember'))
                ->join('salts\Leavedays\Models\Leaves', 'core_member.member_id = leaves.member_id', 'leaves')
                ->Where('core_member.deleted_flag = 0')
                ->orderBy('leaves.date DESC')
                ->getQuery()
                ->execute();        
        $page = $this->base->pagination($row, $currentPage);        
        return $page;
    }
    
      public function getLeavedayleftList($currentPage) {
        $mth = date('m');
        $row = $this->modelsManager->createBuilder()
                ->columns(array('core_member.*'))
                ->from(array('core_member' => 'salts\Core\Models\Db\CoreMember'))
                ->Where('core_member.deleted_flag = 0')
                ->getQuery()
                ->execute();        
        $page = $this->base->pagination($row, $currentPage);        
        return $page;
    }

    public function getNotiInfo($module_name, $Noti_id) {
        $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*', 'leaves.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->join('salts\Leavedays\Models\Leaves', 'core.member_id = leaves.member_id', 'leaves')
                ->Where('leaves.noti_id = :Noti_id:', array('Noti_id' => $Noti_id))
                ->getQuery()
                ->execute();
        return $row;
    }

   public function getAbsent() {
        $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->Where('core.deleted_flag = 0')
                ->getQuery()
                ->execute();
        foreach ($row as $value) {
             if ($value->working_year_by_year == NULL OR $value->working_year_by_year=='0000-00-00') {
            $end_date = date('Y-m-d', strtotime("+1 year", strtotime($value->working_start_dt)));
            $start_date=$value->working_start_dt;
        } else {
            $end_date = date('Y-m-d', strtotime("+1 year", strtotime($value->working_year_by_year)));
            $start_date = $value->working_year_by_year;
        }
            
            $result = $this->db->query("select * from attendances where attendances.member_id='" . $value->member_id . "'"
                    . "and att_date>='" . $start_date . "' and att_date<='" . $end_date . "'and (status = 1 or status = 2)");
            $data = $result->fetchall();
             $sql2 = "select count(status) as countAbsent from attendances where member_id='" . $value->member_id . "' "
                    . "and att_date>='" . $start_date . "' and att_date<='" . $end_date . "' and deleted_flag=0 and (status = 3)";
            $result2 = $this->db->query($sql2);
            $row2 = $result2->fetcharray();
        
            $absent[$value->member_id] = count($data);//4
             $absent[$value->member_id]+=(($row2['countAbsent'])/2);  //4.5
             $absent[$value->member_id]= ($absent[$value->member_id]); 
//            echo $value->member_login_name;
//            echo $start_date;
//            echo $end_date;
//             $absent[$value->member_id];
            
        }
        return $absent;
    }

    public function getAbsentById($id) {
        $result = $this->db->query("select * from attendances where attendances.member_id = '" . $id . "' and (status = 1 or status = 2)");
        $data = count($result->fetchall());
        return $data;
    }

    /**
     * Search for leave list
     * @param type $ltype
     * @param type $month
     * @param type $namelist
     * @return type
     * @author zinmon
     */
    public function search($ltype, $month, $namelist, $currentP) {
        $filter = new Filter();
        $ltype = $filter->sanitize($ltype, "string");
        $namelist = $filter->sanitize($namelist, "string");      
        $select = "SELECT date(leaves.date) as date,core_member.member_login_name,core_member.member_id,date(leaves.start_date)"
                . "as start_date, date(leaves.end_date) as end_date,leaves.leave_days,"
                . "leaves.leave_category,leaves.leave_description,leaves.leave_status,"
                . "leaves.total_leavedays,ls.max_leavedays FROM  salts\Leavedays\Models\LeavesSetting ls INNER JOIN salts\Leavedays\Models\Leaves leaves JOIN "
                . "salts\Core\Models\Db\CoreMember core_member ON "
                . "leaves.member_id= core_member.member_id "
                . "and core_member.deleted_flag = 0 ";
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
            $sql .= " WHERE " . implode(' AND ', $conditions) . "order by leaves.date desc";
        }

        $result = $this->modelsManager->executeQuery($sql);
        $page = $this->base->pagination($result, $currentP);       
        return $page;
    }

    /**
     * Get today attendance list
     * @return type
     * @author David JP <david.gnext@gmail.com>
     */
    public function applyLeave($uname, $sdate, $edate, $type, $desc, $creator_id) {
        $CoreMember = new CoreMember();
        $name = $CoreMember->getUsernameById($creator_id);
        $filter = new Filter();
        $uname = $filter->sanitize($uname, "string");
        $type = $filter->sanitize($type, "string");
        $desc = $filter->sanitize($desc, "string");

        $this->db = $this->getDI()->getShared("db");
        $cond = array();
        if (isset($sdate) AND isset($edate) AND isset($desc)) {
            $Noti_id = rand();
            $today = date("Y-m-d H:i:s");
            $checkday = date("Y-m-d", strtotime("+7 days"));
            $ssdate = date("Y-m-d", strtotime($sdate));
            $eedate = date("Y-m-d", strtotime($edate));
            $sdate = date("Y-m-d H:i:s", strtotime($sdate));
            $edate = date("Y-m-d H:i:s", strtotime($edate));
            $sH = explode(" ", $sdate);
            $eH = explode(" ", $edate);
            $leave = new Leaves();
            $checkLeave = $leave::find("((start_date >= '$sdate' and start_date <= '$edate') or (end_date >='$sdate' and end_date <= '$edate')) and member_id = '$uname'");
            if (count($checkLeave)) {
                $cond["error"] = "You have applied leave this day already";
            } else {
                if ($ssdate >= $checkday && $eedate >= $checkday) {
                    //check $edate greater than $sdate
                    if (strtotime($ssdate) <= strtotime($eedate)) {
                        //for calculate leave day
                        $leave_day = ((strtotime($eedate) - strtotime($ssdate)) / 86400) + 1;

                        if ($sH[1] == "12:00:00") {
                            $leave_days = (int) $leave_day;
                            $leave_day = $leave_days - 0.5;
                        }
                        if ($eH[1] == "12:00:00") {
                            $leave_days = (int) $leave_days;
                            $leave_day = $leave_day - 0.5;
                        }

                        $leave->member_id = $filter->sanitize($uname, "string");
                        $leave->date = $today;
                        $leave->start_date = $sdate;
                        $leave->end_date = $edate;
                        $leave->leave_days = $leave_day;
                        $leave->leave_category = $type;
                        $leave->leave_description = $filter->sanitize($desc, "string");
                        $leave->leave_status = 0;
                        $leave->noti_id = $Noti_id;
                        $leave->created_dt = date("Y-m-d");
                        $leave->save();
                        $alluser = CoreMember::find("deleted_flag = 0");
                        $users = $alluser->toArray();
                        foreach ($users as $user) {
                            $core_noti = new \salts\Core\Models\Db\CoreNotification();
                            $core_noti->creator_name = $filter->sanitize($name, "string");
                            $core_noti->noti_creator_id = $user['member_id'];
                            $core_noti->module_name = "leaves";
                            $core_noti->noti_id = $Noti_id;
                            $core_noti->noti_status = 0;
                            $core_noti->save();
                        }
                        $rel_member = new \salts\Core\Models\Db\CoreNotificationRelMember();
                        $rel_member->creator_name = $name;
                        $rel_member->member_id = $uname;
                        $rel_member->noti_id = $Noti_id;
                        $rel_member->status = 0;
                        $rel_member->module_name = "leaves";
                        $rel_member->save();
                        $cond['success'] = "Your Leave Applied Successfully!";
                    } else {
                        $cond['error'] = "End date must be greater than Start date";
                    }
                } else {
                    $cond['error'] = "Apply Leave Before a week ";
                }
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
    public function getContractData($id) {
        $credt = \salts\Core\Models\CoreMember::findByMemberId($id);
        $created_date = $credt->toArray();
        if ($created_date[0]['working_year_by_year'] == NULL) {
            $date['startDate'] = $created_date[0]['working_start_dt'];
            $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date[0]['working_start_dt'])));
        } else {
            $date['startDate'] = $created_date[0]['working_year_by_year'];
            $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date[0]['working_year_by_year'])));
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
    public function getUserLeaveList($leave_type, $mth, $id, $currentPage) {
        //select leave list
        $filter = new Filter();
        $leave_type = $filter->sanitize($leave_type, "string");

        $this->db = $this->getDI()->getShared("db");
        if ($leave_type == null and $mth == null) {

            $mth = date('m');
            $row = "select core_member.*,leaves.* "
                    . "from salts\Core\Models\Db\CoreMember as core_member"
                    . " left join salts\Leavedays\Models\Leaves as leaves on "
                    . "core_member.member_id = leaves.member_id"
                    . " where month(leaves.start_date)='" . $mth . "' "
                    . "AND leaves.member_id ='" . $id . "' order by date desc ";
        } else {
            //for searching by leave type and month           
            $row = "select core_member.*,leaves.* "
                    . "from salts\Core\Models\Db\CoreMember as core_member"
                    . " left join salts\Leavedays\Models\Leaves as leaves on "
                    . "core_member.member_id = leaves.member_id "
                    . "where " . $this->setCondition2($mth, $leave_type)
                    . "AND leaves.member_id ='" . $id . "' order by date desc";
        }
        $result = $this->modelsManager->executeQuery($row);        
        $page = $this->base->pagination($result, $currentPage);        
        return $page;
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
    public function acceptLeave($id, $days, $noti_id) {
        $this->db = $this->getDI()->getShared("db");
        $date = $this->getContractData($id);
        $sql = Leaves::find("member_id ='$id' AND start_date BETWEEN '" . $date["startDate"] . "' AND '" . $date["endDate"] . "'");
        $leave = \salts\Core\Models\Permission::tableObject($sql);
        $leave->total_leavedays += $days;
        $leave->update();
        $status = 1;
        $noti_sql = Leaves::find("noti_id ='$noti_id'");
        $leave_noti = \salts\Core\Models\Permission::tableObject($noti_sql);
        $leave_noti->leave_status = $status;
        $leave_noti->update();
        $this->db->query("UPDATE core_notification set"
                . " core_notification.noti_status=1  "
                . "WHERE core_notification.noti_id='" . $noti_id . "'");
        $this->db->query("UPDATE core_notification_rel_member "
                . "set core_notification_rel_member.status=1,module_name='leaves',created_time='now()' "
                . " WHERE core_notification_rel_member.noti_id='" . $noti_id . "'");
    }

    /**
     * 
     * @param type $id
     * @param type $sdate
     * change leave status to '2'
     * when admin reject leavedays request from user
     */
    public function rejectLeave($noti_id) {

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

    public function getLeaveSetting() {
        $row = $this->modelsManager->createBuilder()
                ->columns('max_leavedays,fine_amount')
                ->from('salts\Leavedays\Models\LeavesSetting')
                ->getQuery()
                ->execute();
        return $row;
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @return cond array
     * @desc   Validate Form 
     */
    public function validating($data) {
        $res = array();
        $validate = new Validation();
        $validate->add('username', new PresenceOf(
                array(
            'message' => ' * Username is required'
                )
        ));
        $validate->add('sdate', new PresenceOf(
                        array(
                    'message' => ' * Start Date is required'
                        )
                ))
                ->add('edate', new PresenceOf(
                        array(
                    'message' => ' * End Date is required'
        )));
        $validate->add('description', new PresenceOf(
                array(
            'message' => " * Reason Must be Insert"
        )));


        $messages = $validate->validate($data);
        if (count($messages)) {
            foreach ($messages as $message) {
                $res[] = $message;
            }
        }
        return $res;
    }

    public function userValidation($data) {
        $res = array();
        $validate = new Validation();
        $validate->add('sdate', new PresenceOf(
                        array(
                    'message' => ' * Start Date is required'
                        )
                ))
                ->add('edate', new PresenceOf(
                        array(
                    'message' => ' * End Date is required'
        )));
        $validate->add('description', new PresenceOf(
                array('message' => " * Reason Must be Insert")));
        $messages = $validate->validate($data);
        if (count($messages)) {
            foreach ($messages as $message) {
                $res[] = $message;
            }
        }
        return $res;
    }  

}
