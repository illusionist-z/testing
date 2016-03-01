<?php

namespace salts\Leavedays\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use salts\Core\Models\Db\CoreMember;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Filter;

class Leaves extends \Library\Core\Models\Base {

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
    public function getLeaveList($currentPage) {
        $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*', 'leaves.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->join('salts\Leavedays\Models\Leaves', 'core.member_id = leaves.member_id', 'leaves')
                ->Where('core.deleted_flag = 0')
                ->orderBy('leaves.date DESC')
                ->getQuery()
                ->execute();
             $paginator = new PaginatorModel(
                            array(
                        "data" => $row,
                        "limit" => 10,
                        "page" => $currentPage
                            )
                         );

// Get the paginated results
        $page = $paginator->getPaginate();
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
                ->columns(array('core.*', 'leaves.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->join('salts\Leavedays\Models\Leaves', 'core.member_id = leaves.member_id', 'leaves')
                ->Where('core.deleted_flag = 0')
                ->orderBy('leaves.date DESC')
                ->getQuery()
                ->execute();
        foreach ($row as $value) {

            $result = $this->db->query("select * from attendances where attendances.member_id='" . $value->core->member_id . "'"
                    . "and attendances.status=2");
            $data = $result->fetchall();
            $absent[$value->core->member_id] = count($data);
        }
        return $absent;
    }

    public function getAbsentById($id) {
        $result = $this->db->query("select * from attendances where attendances.member_id = '" . $id . "' and attendances.status=2");
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
    public function search($ltype, $month, $namelist) {
        $filter = new Filter();
        $ltype = $filter->sanitize($ltype, "string");
        $namelist = $filter->sanitize($namelist, "string");

        $select = "SELECT date(date) as date,member_login_name,date(start_date)"
                . "as start_date, date(end_date) as end_date,leave_days,"
                . "leave_category,leave_description,leave_status,"
                . "total_leavedays,max_leavedays FROM leaves_setting,"
                . " leaves JOIN core_member ON "
                . "leaves.member_id=core_member.member_id "
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

        $result = $this->db->query($sql);
        $list = $result->fetchall();
        return $list;
    }

    /**
     * Get today attendance list
     * @return type
     * @author David JP <david.gnext@gmail.com>
     * @version Su Zin Kyaw< suzinkyaw.gnext@gmail.com>
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
        $this->getContractData($uname);
        $ldata = Leaves::find("member_id = '$uname' order by date DESC LIMIT 1");
        $list = $ldata->toArray();

        if ($list == NULL) {
            $lastdata = "0";
        } else {
            $lastdata = ($list['0']['total_leavedays']);
        }
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
                    $leave = new Leaves();
                    $leave->member_id = $filter->sanitize($uname,"string");
                    $leave->date  =  $today;
                    $leave->start_date = $sdate;
                    $leave->end_date = $edate;
                    $leave->leave_days = $leave_day;
                    $leave->leave_category = $type;
                    $leave->leave_description = $filter->sanitize($desc,"string");
                    $leave->total_leavedays = $lastdata;
                    $leave->leave_status = 0 ;
                    $leave->noti_id = $Noti_id;
                    $leave->created_dt = date("Y-m-d");
                    $leave->save();
                    $alluser = CoreMember::find("deleted_flag = 0");
                    $users = $alluser->toArray();
                    foreach ($users as $user) {
                        $core_noti = new \salts\Core\Models\Db\CoreNotification();
                        $core_noti->creator_name = $filter->sanitize($name,"string");
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
    public function getUserLeaveList($leave_type, $mth, $id) {
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
                    . "where " . $this->setCondition2($mth, $leave_type)
                    . "AND leaves.member_id ='" . $id . "' order by date desc";
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
    public function acceptLeave($id, $days, $noti_id) {        
        $date = $this->getContractData($id);
        $sql = Leaves::find("member_id ='$id' AND start_date BETWEEN '".$date["startDate"]."' AND '".$date["endDate"]."'");
        $leave = \salts\Core\Models\Permission::tableObject($sql);
        $leave->total_leavedays += $days ;
        $leave->update();
        $status = 1;
        $noti_sql = Leaves::find("noti_id ='$noti_id'");
        $leave_noti = \salts\Core\Models\Permission::tableObject($noti_sql);
        $leave_noti->leave_status = $status;
        $leave_noti->update();
        $core_noti_sql = \salts\Core\Models\Db\CoreNotification::findByNotiId($noti_id);
        $core_noti = \salts\Core\Models\Permission::tableObject($core_noti_sql);
        $core_noti->status = $status;
        $core_noti->update();
        $rel_member_sql = \salts\Core\Models\Db\CoreNotificationRelMember::findByNotiId($noti_id);
        $rel_member = \salts\Core\Models\Permission::tableObject($rel_member_sql);
        $rel_member->status = $status;
        $rel_member->module_name = "leaves";
        $rel_member->created_time = date("Y-m-d H:i:s");
        $rel_member->update();
    }

    /**
     * 
     * @param type $id
     * @param type $sdate
     * change leave status to '2'
     * when admin reject leavedays request from user
     * @author Su Zin Kyaw<gnext.suzin@gmail.com
     */
    public function rejectLeave($noti_id) {
        $leave_sql = Leaves::findByNotiId($noti_id);
        $leave = \salts\Core\Models\Permission::tableObject($leave_sql);
        $leave->leave_status = 2 ;
        $leave->update();
        $core_noti_sql = \salts\Core\Models\Db\CoreNotification::findByNotiId($noti_id);
        $core_noti = \salts\Core\Models\Permission::tableObject($core_noti_sql);
        $core_noti->noti_status = 1;
        $core_noti->update();
        $rel_member_sql = \salts\Core\Models\Db\CoreNotificationRelMember::findByNotiId($noti_id);
        $rel_member = \salts\Core\Models\Permission::tableObject($rel_member_sql);
        $rel_member->status = 1;
        $rel_member->module_name = "leaves";
        $rel_member->update();        
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

}
