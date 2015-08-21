<?php

namespace workManagiment\Attendancelist\Models;

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

use workManagiment\Core\Models\Db\CoreMember as CoreMember;
use workManagiment\Attendancelist\Models\Attendances as Attendances;
//use workManagiment\Auth\Models\Db\CoreMember as corememberresult;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendances extends Model {
    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    /**
     * Get today attendance list
     * @return type
     * @author zinmon
     */
    public function gettodaylist($name) {        
        $today = date("Y:m:d");                
        // for search result
        if (isset($name)) {
           $query = "select * from core_member JOIN attendances On core_member.member_id = attendances.member_id where core_member.member_login_name='".$name."' and attendances.att_date ='".$today."'";
        } else {
            //show att today list
           $query = "select * from core_member JOIN attendances On core_member.member_id = attendances.member_id where attendances.att_date ='".$today."'";
        }
        $result = $this->db->query($query);
        $rows = $result->fetchall();
        return $rows;
    }

    /**
     * Get user name
     * @return type
     * @author zinmon
     */
    public function getusername() {        
        $user_name = $this->db->query("SELECT * FROM core_member");
        //print_r($user_name);exit;
        $getname = $user_name->fetchall();
        return $getname;
    }

    /**
     * get Attendance List By User ID 
     * @author Su Zin Kyaw
     */
    public function getattlist($id, $month) {        
        $currentmth = date('m');
        //for search method
        if (isset($month)) {
            $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng,overtime,location')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->orderBy('workManagiment\Attendancelist\Models\Attendances.att_date DESC')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $month . ' AND workManagiment\Attendancelist\Models\Attendances.member_id =' . "'$id'")
                    ->getQuery()
                    ->execute();
        }
        //showing data with current month 
        else {
            $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng,overtime,location')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->orderBy('workManagiment\Attendancelist\Models\Attendances.att_date DESC')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $currentmth . ' AND workManagiment\Attendancelist\Models\Attendances.member_id =' . "'$id'")
                    ->getQuery()
                    ->execute();
        }
        //paging
        $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 5,
            "page" => $currentPage
                )
        );                
        $list = $paginator->getPaginate();
        return $list;
    }

    /**
     * Show monthly attendance list
     * @param type $year
     * @param type $month
     * @param type $username
     * @return type
     * @author zinmon
     */
    public function showattlist() {
        //search monthly list data
             
            $month = date('m');
            $query = "select * from core_member JOIN attendances On core_member.member_id = attendances.member_id Where MONTH(attendances.att_date) ='".$month."' order by attendances.att_date DESC";
            $result = $this->db->query($query);
            $row  = $result->fetchall();
            return $row;
      
    }
    
    /**
     * Search attendance list
     * @param type $year
     * @param type $month
     * @param type $username
     * @return type
     * @author zinmon
     */
    public function search_attlist($year,$month,$username) {
        try {
         $select = "SELECT * FROM core_member JOIN attendances ON core_member.member_id=attendances.member_id ";
         $conditions=$this->setCondition($year, $month, $username);

              $sql = $select;
              if (count($conditions) > 0) {
              $sql .= " WHERE " . implode(' AND ', $conditions);
              }
              //echo $sql;exit;
              $result = $this->db->query($sql);
              $row = $result->fetchall();
        } catch (Exception $ex) {
           echo $ex; 
        }
        
        return $row;
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

              if ($year != "") {
              $conditions[] = "YEAR(attendances.att_date) like " . $year;
              }
              if ($month != "") {
              $conditions[] = "MONTH(attendances.att_date) like " . $month;
              }
              if ($username != "") {
              $conditions[] = "member_login_name='" . $username . "'";
              }
        return $conditions;
    }
    /**
     * @desc   insert absent member to absent 
     * @author David
     * @param  $v[0] = member_id
     */
    public function absent(){        
        $query = "Select member_id from core_member where member_login_name NOT IN (Select member_id from attendances where att_date = CURRENT_DATE AND select member_id from leaves where start_date=CURRENT_DATE)";
        $res   = $this->db->query($query);
        $absent = $res->fetchall();
        $leaves= new workManagiment\Leavedays\Models\Leaves();
        $day=1;
        foreach ($absent as $v){
            
            $date=$leaves->getcontractdata($v[0]);
            $insert = "Insert into absent (id,date,delete_flag) VALUES ('".$v[0]."',CURRENT_DATE,1)";
            $this->db->query($insert);
            $this->db->query("UPDATE leaves set leaves.total_leavedays=total_leavedays+'".$day."' WHERE leaves.member_id='".$v[0]."'  AND date BETWEEN '" . $date['startDate'] . "' AND  '" .  $date['endDate']. "'");

            
        }        
    }
    
   
}
