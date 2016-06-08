<?php

namespace salts\Attendancelist\Models;

use Phalcon\Mvc\Model;
use Phalcon\Filter;

class Attendances extends Model {

    public $base;
    public $filter;
    public $member_id;
    public $att_date;

    public function initialize() {
        $this->filter = new Filter();
        $this->db = $this->getDI()->getShared("db");
        $this->base = new\Library\Core\Models\Base();
    }

    /**
     * Get today attendance list
     * @return type
     * @author zinmon
     */
    public function getTodayList($name, $currentPage, $IsPaging) {
        $today = date("Y:m:d");
        if (isset($name)) {
            $row = $this->modelsManager->createBuilder()->columns(array('core.*', 'attendances.*'))
                            ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                            ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                            ->where('core.member_login_name = :name:', array('name' => $name))
                            ->andWhere('attendances.att_date = :today:', array('today' => $today))->andWhere('core.deleted_flag = 0')
                            ->andWhere('attendances.status = 0 OR attendances.status = 3 OR attendances.status = 4')
                            ->getQuery()->execute();
        } else {
            $row = $this->modelsManager->createBuilder()->columns(array('core.*', 'attendances.*'))
                            ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                            ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                            ->where('attendances.att_date = :today:', array('today' => $today))->andWhere('core.deleted_flag = 0')
                            ->andWhere('attendances.status = 0 OR attendances.status = 3  OR attendances.status = 4')
                            ->orderBy('attendances.checkin_time DESC')
                            ->getQuery()->execute();
        }
        if (1 == $IsPaging) {
            $page = $this->base->pagination($row, $currentPage);
        } else {
            $page = $row;
        }
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
    public function getAttList($id, $year, $month, $currentPage, $IsPaging) {
        try {
            $currentmth = date('m');
            $currentYear = date('Y');
            if (isset($year) || isset($month)) {
                $start = date("Y-m-d", strtotime($year));
                $end = date("Y-m-d", strtotime($month));
                $row = $this->modelsManager->createBuilder()->columns(array('core.*', 'attendances.*'))
                                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                                ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                                ->where('attendances.att_date >= :start:', array('start' => $start))
                                ->andWhere('attendances.att_date <= :end:', array('end' => $end))
                                ->andWhere('attendances.member_id = :id:', array('id' => $id))->andWhere('core.deleted_flag = 0 and (attendances.status = 0 OR attendances.status = 3)')
                                ->orderBy('attendances.att_date DESC')
                                ->getQuery()->execute();
            } else {
                $row = $this->modelsManager->createBuilder()->columns(array('core.*', 'attendances.*'))
                                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                                ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                                ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                                ->andWhere('YEAR(attendances.att_date) = :currentYr:', array('currentYr' => $currentYear))
                                ->andWhere('attendances.member_id = :id:', array('id' => $id))
                                ->andWhere('core.deleted_flag = 0 and (attendances.status = 0 OR attendances.status = 3)')
                                ->orderBy('attendances.att_date DESC')
                                ->getQuery()->execute();
            }
            if (0 != $IsPaging) {
                $page = $this->base->pagination($row, $currentPage);
            } else {
                $page = $row;
            }
        } catch (Exception $err) {
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
    public function showAttList($currentPage, $IsPaging) {
        //search monthly list data     
        $month = date('m');
        $year = date('Y');
        $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*', 'attendances.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                ->where('MONTH(attendances.att_date) = :month: ', array('month' => $month))
                ->andWhere('YEAR(attendances.att_date) = :year: ', array('year' => $year))
                ->andWhere('core.deleted_flag = 0')
                ->andWhere('attendances.status = 0')
                ->orderBy('attendances.checkin_time DESC')
                ->getQuery()
                ->execute();
        if (1 == $IsPaging) {
            $page = $this->base->pagination($row, $currentPage);
        } else {
            $page = $row;
        }
        return $page;
    }

    /**
     * @desc    Has already in attendance table
     * @param type $id
     * @return 1 || 0
     */
    public function checkAttendance($id) {
        $current = date("Y-m-d");
        $hasId = Attendances::find("member_id ='" . $id . "' and att_date ='" . $current . "'");
        return count($hasId);
    }

    /**
     * @desc   insert absent member to absent 
     * @author David
     * @param  $v[0] = member_id
     */
    public function absent($id) {
        //get today absent list
        $sql = "Select member_id from core_member where member_id NOT IN (select member_id from "
                . "attendances where att_date = CURRENT_DATE) AND deleted_flag=0 AND member_id='" . $id . "' order by created_dt desc";
        $absentlist = $this->db->query($sql);
        $finalresult = $absentlist->fetcharray();
        if ($finalresult != null) {
            $string = "";
            //get absent member id           
            $string .= "'" . $finalresult['member_id'] . "',";
            $insert_string = substr_replace($string, "", -1);
            //get absent applied leave id
            $checkleavequery = "SELECT member_id  FROM leaves where member_id IN ($insert_string) and "
                    . "CURRENT_DATE in (start_date,end_date)";

            $checkleave = $this->db->query($checkleavequery);
            $checkresult = $checkleave->fetchall();
            $this->InsertAbsentStatus($checkresult, $finalresult['member_id'], $id);
            $message = "Adding is successfully";
        } else {
            $message = "Already Exist";
        }
        return $message;
    }

    public function InsertAbsentStatus($checkresult, $finalresult, $id) {
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
            $insert .= "('" . $finalresult . "',CURRENT_DATE,2),";
        }
        $insertquery = substr_replace($insert, ";", -1);
        $this->db->query($insertquery);
    }

    public function GetAbsentList($current_page) {
        try {
            $attid = 'Select member_id from attendances where att_date = CURRENT_DATE and status = 0';
            $attendancelist = $this->db->query($attid);
            $finalresult = $attendancelist->fetchall();
            $final = array();
            if (empty($finalresult)) {
                array_push($final, '0');
            }

            foreach ($finalresult as $value) {
                array_push($final, $value['member_id']);
            }
            $row = $this->modelsManager->createBuilder()->columns("core.*")
                            ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                            ->notInWhere('core.member_id', $final)
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
        $id = $this->filter->sanitize($id, "int");
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
        $row->checkin_time = $utctime;
        $row->status = $hour < 12 ? 0 : 3;
        $row->update();
    }

    /**
     * @vesion query

     */
    public function searchAttList($year, $month, $username, $currentPage, $IsPaging) {

        try {
            $conditions = $this->setCondition($year, $month, $username);
            if (count($conditions) > 0) {
                $row = $this->modelsManager->createBuilder()->columns(array("core.*,attendances.*"))
                                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                                ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                                ->where(implode(' AND ', $conditions))
                                ->andWhere('core.deleted_flag = 0')
                                ->andWhere('attendances.status = 0')
                                ->orderBy('attendances.checkin_time DESC')
                                ->getQuery()->execute();
            }
            if (1 == $IsPaging) {
                $page = $this->base->pagination($row, $currentPage);
            } else {
                $page = $row;
            }
        } catch (Exception $ex) {
            echo $ex;
        }
        return $page;
    }

    public function currentAttList($currentPage) {
        try {
            $currentmth = date('m');
            $currentYr = date("Y");
            $row = $this->modelsManager->createBuilder()
                    ->columns(array("core.member_login_name", "group_concat(DAY(attendances.att_date)) as day"
                        . ",attendances.member_id,group_concat(attendances.status) as status"))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                    ->andWhere('YEAR(attendances.att_date) = :currentYear:', array('currentYear' => $currentYr))
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
    public function searchByTwoOption($search_date_month,$search_date_year,$search_dept,$currentPage)  {
        try {
            $currentmth = date('m');
            $currentYr = date("Y");
            if ($search_dept == 'Select Dept'){
                if ($search_date_year !== 'Year'){
                $row = $this->modelsManager->createBuilder()
                    ->columns(array("core.member_login_name", "group_concat(DAY(attendances.att_date)) as day"
                        . ",attendances.member_id,group_concat(attendances.status) as status"))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $search_date_month))
                    ->andWhere('YEAR(attendances.att_date) = :currentYear:', array('currentYear' => $search_date_year))
                     ->andWhere('core.deleted_flag = 0')
                    ->groupBy('core.member_id')
                    ->getQuery()
                    ->execute();
            }
            else if  ($search_date_month == 'Month' && $search_date_year !== 'Year'){
                $row = $this->modelsManager->createBuilder()
                    ->columns(array("core.member_login_name", "group_concat(DAY(attendances.att_date)) as day"
                        . ",attendances.member_id,group_concat(attendances.status) as status"))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                    ->andWhere('YEAR(attendances.att_date) = :currentYear:', array('currentYear' => $search_date_year))
                     ->andWhere('core.deleted_flag = 0')
                    ->groupBy('core.member_id')
                    ->getQuery()
                    ->execute();
            }
            else if  ($search_date_month !== 'Month' && $search_date_year == 'Year'){
                $row = $this->modelsManager->createBuilder()
                    ->columns(array("core.member_login_name", "group_concat(DAY(attendances.att_date)) as day"
                        . ",attendances.member_id,group_concat(attendances.status) as status"))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $search_date_month))
                    ->andWhere('YEAR(attendances.att_date) = :currentYear:', array('currentYear' => $currentYr))
                     ->andWhere('core.deleted_flag = 0')
                    ->groupBy('core.member_id')
                    ->getQuery()
                    ->execute();
            }
             else if  ($search_date_month == 'Month' && $search_date_year == 'Year'){
                $row = $this->modelsManager->createBuilder()
                    ->columns(array("core.member_login_name", "group_concat(DAY(attendances.att_date)) as day"
                        . ",attendances.member_id,group_concat(attendances.status) as status"))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                    ->andWhere('YEAR(attendances.att_date) = :currentYear:', array('currentYear' => $currentYr))
                     ->andWhere('core.deleted_flag = 0')
                    ->groupBy('core.member_id')
                    ->getQuery()
                    ->execute();
            }
             else if  ($search_date_month == 'Month' && $search_date_year == 'Year' && $search_dept == 'Select Dept'){
                $row = $this->modelsManager->createBuilder()
                    ->columns(array("core.member_login_name", "group_concat(DAY(attendances.att_date)) as day"
                        . ",attendances.member_id,group_concat(attendances.status) as status"))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                    ->andWhere('YEAR(attendances.att_date) = :currentYear:', array('currentYear' => $currentYr))
                    ->andWhere('core.member_dept_name = :search_dept:', array('search_dept' => $search_dept))
                     ->andWhere('core.deleted_flag = 0')
                    ->groupBy('core.member_id')
                    ->getQuery()
                    ->execute();
            }
            }
             
            else{
                 $row = $this->modelsManager->createBuilder()
                    ->columns(array("core.member_login_name", "group_concat(DAY(attendances.att_date)) as day"
                        . ",attendances.member_id,group_concat(attendances.status) as status"))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $search_date_month))
                    ->andWhere('YEAR(attendances.att_date) = :currentYear:', array('currentYear' => $search_date_year))
                    
                    ->andWhere('core.deleted_flag = 0')
                    ->groupBy('core.member_id')
                    ->getQuery()
                    ->execute();
            }
           
            var_dump($row);
          // exit(); 
            $page = $this->base->pagination($row, $currentPage);
           
        } catch (Exception $ex) {
            echo $ex;
        }
        return $page;
    }

    /**
     * Set Condition
     * @param type $search_date_month
     * @param type $search_date_year
     * @param type $search_dept
     * @param type $currentPage
     * @return string
     * @author yan lin pai
     */
    
    public function setCondition($year, $month, $username) {
        $conditions = array();

        if ($year) {
            $start = date("Y-m-d", strtotime($year));
            $conditions[] = "attendances.att_date >=  ' " . $start . " ' ";
        }
        if ($month) {
            $end = date("Y-m-d", strtotime($month));
            $conditions[] = "attendances.att_date <=  ' " . $end . " ' ";
        }
        if ($username) {
            $conditions[] = "core.member_login_name ='" . $username . "'";
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
            $start_date = $this->filter->sanitize($salary_start_date, "string");
            $dt = explode('-', $start_date);
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
        $id = $this->filter->sanitize($id, "string");
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
