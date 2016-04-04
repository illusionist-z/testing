<?php

namespace salts\Attendancelist\Models;

use Phalcon\Mvc\Model;

class Attendances extends Model {
    public $base;
    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
        $this->base = new\Library\Core\Models\Base();
    }
    /**
     * Get today attendance list
     * @return type
     * @author zinmon
     */
    public function getTodayList($name, $currentPage) {
        $today = date("Y:m:d");
        if (isset($name)) {
            $row = $this->modelsManager->createBuilder()->columns(array('core.*', 'attendances.*'))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
  ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('core.member_login_name = :name:', array('name' => $name))
  ->andWhere('attendances.att_date = :today:', array('today' => $today))->andWhere('core.deleted_flag = 0')
                    ->andWhere('attendances.status = 0 OR attendances.status = 3')
                    ->getQuery()->execute();
        } else {
            $row = $this->modelsManager->createBuilder()->columns(array('core.*', 'attendances.*'))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
  ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
        ->where('attendances.att_date = :today:', array('today' => $today))->andWhere('core.deleted_flag = 0')
                    ->andWhere('attendances.status = 0 OR attendances.status = 3')
                    ->orderBy('attendances.checkin_time DESC')
                    ->getQuery()->execute();
        }
        $page = $this->base->pagination($row, $currentPage);
        return $page;
    }
    /**
     * Get user name
     * @return type
     * @author zinmon
     */
    public function getUsername() {
        $user_name = $this->db->query("SELECT * FROM core_member");
        $getname = $user_name->fetchall();
        return $getname;
    }
    /**
     * get Attendance List By User ID 
     * @author Su Zin Kyaw
     * for user
     */
    public function getAttList($id, $year, $month,$currentPage) {
        try{
        $currentmth = date('m');
        if (isset($year) || isset($month)) {
            $start = date("Y-m-d", strtotime($year));$end = date("Y-m-d", strtotime($month));
            $row = $this->modelsManager->createBuilder()->columns(array('core.*', 'attendances.*'))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
  ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('attendances.att_date >= :start:', array('start' => $start))
                    ->andWhere('attendances.att_date <= :end:', array('end' => $end))
             ->andWhere('attendances.member_id = :id:', array('id' => $id))->andWhere('core.deleted_flag = 0')
                    ->orderBy('attendances.att_date DESC')
                    ->getQuery()->execute();
        } else {
            $row = $this->modelsManager->createBuilder()->columns(array('core.*', 'attendances.*'))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
  ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                    ->andWhere('attendances.member_id = :id:', array('id' => $id))
                    ->andWhere('core.deleted_flag = 0 and (attendances.status = 0 OR attendances.status = 3)')
                    ->orderBy('attendances.att_date DESC')
                    ->getQuery()->execute();
        }
        $page = $this->base->pagination($row, $currentPage);
        }
        catch (Exception $err){
            echo $err;
        }
        return $page;
    }
    /**
     * Show monthly attendance list
     * @param type $year
     * @param type $month
     * @param type $username
     * @return type
     * @author zinmon
     */
    public function showAttList($currentPage) {
        //search monthly list data     
        $month = date('m');
        $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*', 'attendances.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                ->where('MONTH(attendances.att_date) = :month: ', array('month' => $month))
                ->andWhere('core.deleted_flag = 0')
                ->andWhere('attendances.status = 0')
                ->orderBy('attendances.checkin_time DESC')
                ->getQuery()
                ->execute();
       $page = $this->base->pagination($row, $currentPage);
        return $page;
    }
    /**
     * @desc    Has already in attendance table
     * @param type $id
     * @return 1 || 0
     */
    public function checkAttendance($id) {
        $current = date("Y-m-d");
        $hasId = Attendances::find("member_id ='".$id."' and att_date ='".$current."'");
        return count($hasId);
    }
       /**
     * @desc   insert absent member to absent 
     * @author David
     * @param  $v[0] = member_id
     */
    public function absent() {
        //get today absent list
        $sql = "Select member_id from core_member where member_id NOT IN (select member_id from "
                . "attendances where att_date = CURRENT_DATE) AND deleted_flag=0 order by created_dt desc";
        $absentlist = $this->db->query($sql);
        $finalresult = $absentlist->fetchall();
        if ($finalresult != null) {
            $string = "";
            //get absent member id
            foreach ($finalresult as $v) {
                $string .= "'" . $v['member_id'] . "',";
            }
            $insert_string = substr_replace($string, "", -1);
            //get absent applied leave id
            $checkleavequery = "SELECT member_id  FROM leaves where member_id IN ($insert_string) and "
                    . "CURRENT_DATE in (start_date,end_date)";
            $checkleave = $this->db->query($checkleavequery);
            $checkresult = $checkleave->fetchall();
            $this->InsertAbsentStatus($checkresult,$finalresult);
            $message = "Adding is successfully";
        } else {
            $message = "Already Exist";
        }
        return $message;
    }
    
    public function InsertAbsentStatus($checkresult,$finalresult) {
            $insert = "Insert into attendances (member_id,att_date,status) VALUES ";
            //insert absent with apply leave
            if (count($checkresult) > 0) {
                foreach ($checkresult as $v) {
                        foreach ($finalresult as $k) {
                            if ($k['member_id'] != $v['member_id']) {
                                $insert .= "('" . $k['member_id'] . "',CURRENT_DATE,2),";
                            }
                    }
                    $insert .= "('" . $v['member_id'] . "',CURRENT_DATE,1),";
                }
            }
            //insert absent with no apply leave
            else {
                foreach ($finalresult as $v) {
                    $insert .= "('" . $v['member_id'] . "',CURRENT_DATE,2),";
                }
            }
            $insertquery = substr_replace($insert, ";", -1);
            $this->db->query($insertquery);            
    }
    
    public function GetAbsentList($current_page) {
        try {
            $currentdate = date('Y-m-d');$member_id = array();
            $phql = "Select member_id from salts\Attendancelist\Models\Attendances where att_date = :current: "
                    . "and (status = 1 or status = 2)";
            $result = $this->modelsManager->executeQuery($phql, array('current' => $currentdate));
            $get_member_id = $result->toArray();
            foreach ($get_member_id as $v) {
                $member_id[] = $v['member_id'];
            }
            $row = $this->modelsManager->createBuilder()->columns("core.*")
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->InWhere('core.member_id',$member_id)
                    ->andWhere('core.deleted_flag = 0')
                    ->orderBy('core.created_dt desc')
                    ->getQuery()->execute();
            $page = $this->base->pagination($row, $current_page);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $page;
    }

    public function getAttTime($id) {
        $query = "select * from core_member JOIN attendances On core_member.member_id = "
                . "attendances.member_id Where attendances.id ='" . $id . "' ";
        $data = $this->db->query($query);
        $result = $data->fetchall();
        return $result;
    }

    /**
     * @version David JP
     * @param date $data [local time]
     * @param type $id
     * @param type $offset
     */
    public function editAtt($data, $id, $offset) {
       
        $utctime = \salts\Core\Models\Db\Attendances::getInstance()->LocalToUTC($data, $offset);
        
        $hour = date("H", strtotime($data));
        $row = Attendances::findFirst("id = '$id'");
     // $attendance = \salts\Core\Models\Permission::tableObject($row);
     
        $row->checkin_time = $utctime;
        $row->status = $hour < 12 ? 0 : 3;
        $row->update();
    }

    public function searchAttList($year, $month, $username,$currentPage) {

         try {
            $select = "SELECT c.member_login_name,att.* FROM salts\Core\Models\Db\CoreMember as c JOIN salts\Attendancelist\Models\Attendances as att"
                    . " ON c.member_id = att.member_id ";
            $conditions = $this->setCondition($year, $month, $username);
            $sql = $select;
            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(' AND ', $conditions) . " AND c.deleted_flag = 0 and "
                        . "att.status=0 ORDER BY att.checkin_time DESC";
            }
            $row = $this->modelsManager->executeQuery($sql);
            $page = $this->base->pagination($row, $currentPage);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $page;
    }

    public function currentAttList($currentPage) {
        try {
            $currentmth = date('m');
            $row = $this->modelsManager->createBuilder()
                    ->columns(array("core.member_login_name", "group_concat(DAY(attendances.att_date)) as day"
                        . ",attendances.member_id,group_concat(attendances.status) as status"))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
  ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                    ->andWhere('core.deleted_flag = 0')
                    ->groupBy('core.member_id')
                    ->getQuery()
                    ->execute();
                   $page = $this->base->pagination($row, $currentPage);
        } catch (Exception $ex) {
            echo $ex;
        }
        return $page;
    }
    /**
     * Set Condition
     * @param type $year
     * @param type $month
     * @param type $username
     * @return string
     * @author zinmon
     */
    public function setCondition($year, $month, $username) {
        $conditions = array();

        if ($year) {
            $start = date("Y-m-d", strtotime($year));
            $conditions[] = "att.att_date >=  ' " . $start . " ' ";
        }
        if ($month) {
            $end = date("Y-m-d", strtotime($month));
            $conditions[] = "att.att_date <=  ' " . $end . " ' ";
        }
        if ($username) {
            $conditions[] = "c.member_login_name ='" . $username . "'";
        }
        return $conditions;
    }

    /**
     * get count attendance day 
     * @return type
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function getCountattday($salary_start_date) {
        try {
            $dt = explode('-', $salary_start_date);
            $query = "select *,count(att_date) as attdate from attendances join core_member on "
                    . "attendances.member_id=core_member.member_id where YEAR(att_date)='" . $dt[0] . "' and "
                    . "MONTH(att_date)='" . $dt[1] . "' group by core_member.member_id";
            $data = $this->db->query($query);
            $result = $data->fetchall();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $result;
    }

    public function getContractData($id) {
        $credt = $this->db->query("SELECT * "
                . "FROM core_member WHERE core_member.member_id= '" . $id . "'");
        $created_date = $credt->fetchArray();

        if ($created_date['working_year_by_year'] == NULL) {
            $date['startDate'] = $created_date['working_start_dt'];
            $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date['working_start_dt'])));
        } else {
            $date['startDate'] = $created_date['working_year_by_year'];
            $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date['working_year_by_year'])));
        }
        return $date;
    }

}
