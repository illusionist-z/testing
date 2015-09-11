<?php

namespace workManagiment\Attendancelist\Models;

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

use workManagiment\Core\Models\Db\CoreMember as CoreMember;
use workManagiment\Attendancelist\Models\Attendances as Attendances;

         use Phalcon\Filter; 
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
        /*if (isset($name)) {
           $query = "select * from core_member JOIN attendances On core_member.member_id = attendances.member_id where core_member.member_login_name='".$name."' and attendances.att_date ='".$today."'";
        } else {
            //show att today list
           $query = "select * from core_member JOIN attendances On core_member.member_id = attendances.member_id where attendances.att_date ='".$today."'";
        }
        $result = $this->db->query($query);
        $rows = $result->fetchall();
        return $rows;*/
        
        if(isset($name)){
           
           //print_r($today);exit;
           $row =   $this->modelsManager->createBuilder()
                         ->columns(array('core.*', 'attendances.*'))
                         ->from(array('core' => 'workManagiment\Core\Models\Db\CoreMember'))
                         ->join('workManagiment\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                         ->where('core.member_login_name = :name:', array('name' => $name))
                         ->andWhere('attendances.att_date = :today:', array('today' => $today))
                         ->getQuery()
                         ->execute();          
                // print_r($row);exit;
                   /* foreach($row as $rows) {
                          echo $rows->core->member_login_name;
                          echo $rows->attendances->att_date;
                    }
                    exit;*/
           
           
                    
        }else{
            $row =   $this->modelsManager->createBuilder()
                          ->columns(array('core.*', 'attendances.*'))
                          ->from(array('core' => 'workManagiment\Core\Models\Db\CoreMember'))
                          ->join('workManagiment\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                          ->where('attendances.att_date = :today:', array('today' => $today))
                          ->andWhere('core.deleted_flag = 0')
                          ->orderBy('attendances.checkin_time DESC')
                          ->getQuery()
                          ->execute(); 
            
                // print_r($row);exit;
                   /* foreach($row as $rows) {
                          echo $rows->core->member_login_name;
                          echo $rows->attendances->att_date;
                    }
                    exit;*/
        }
       // print_r($row);exit;
        return $row;
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
     * for user
     */
    public function getattlist($id, $month) {        
        $currentmth = date('m');
        //for search method
        /*if (isset($month)) {
            $row = "Select att_date,member_login_name,checkin_time,checkout_time,lat,lng,overtime,location from core_member left join attendances on core_member.member_id = attendances.member_id where MONTH(attendances.att_date) ='".$month."' AND attendances.member_id ='".$id."' order by attendances.att_date DESC ";                                   
        }
        //showing data with current month 
        else {
            $row = "Select att_date,member_login_name,checkin_time,checkout_time,lat,lng,overtime,location from core_member left join attendances on core_member.member_id = attendances.member_id where MONTH(attendances.att_date) ='".$currentmth."' AND attendances.member_id ='".$id."' order by attendances.att_date DESC ";                                   
        }
        //paging
       $result = $this->db->query($row);
       $list   = $result->fetchall();
        return $list;*/
        
        if(isset($month)){
           //echo "Thank You";
           //print_r($today);exit;
           $row =   $this->modelsManager->createBuilder()
                         ->columns(array('core.*', 'attendances.*'))
                         ->from(array('core' => 'workManagiment\Core\Models\Db\CoreMember'))
                         ->join('workManagiment\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                         ->where('MONTH(attendances.att_date) = :month:', array('month' => $month))
                         ->andWhere('attendances.member_id = :id:', array('id' => $id))
                          ->andWhere('core.deleted_flag = 0')
                         ->orderBy('attendances.att_date DESC')
                         ->getQuery()
                         ->execute();          
                // print_r($row);exit;
                   /* foreach($row as $rows) {
                          echo $rows->core->member_login_name;
                          echo $rows->attendances->att_date;
                    }
                    exit;*/
           
           
                    
        }else{
            $row =   $this->modelsManager->createBuilder()
                         ->columns(array('core.*', 'attendances.*'))
                         ->from(array('core' => 'workManagiment\Core\Models\Db\CoreMember'))
                         ->join('workManagiment\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                         ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                         ->andWhere('attendances.member_id = :id:', array('id' => $id))
                          ->andWhere('core.deleted_flag = 0')
                         ->orderBy('attendances.att_date DESC')
                         ->getQuery()
                         ->execute();           
                //print_r($row);exit;
                   /* foreach($row as $rows) {
                          echo $rows->core->member_login_name;
                          echo $rows->attendances->att_date;
                    }
                    exit;*/
        }
        return $row;
        
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
            $year=date('Y');
            $month = date('m');
            /*$query = "select * from core_member JOIN attendances On core_member.member_id = attendances.member_id Where MONTH(attendances.att_date) ='".$month."' and YEAR(attendances.att_date)='".$year."' order by attendances.att_date DESC";
            //echo $query;exit;
            $result = $this->db->query($query);
            $row  = $result->fetchall();
            return $row;*/
            
            $row = $this->modelsManager->createBuilder()               
                        ->columns(array('core.*', 'attendances.*'))                
                        ->from(array('core' => 'workManagiment\Core\Models\Db\CoreMember'))
                        ->join('workManagiment\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                        ->where('MONTH(attendances.att_date) = :month: ', array('month' => $month))
                        ->andWhere('core.deleted_flag = 0')
                        ->orderBy('attendances.checkin_time DESC')
                        ->getQuery()
                        ->execute();           
                // print_r($row);exit;
                   /*foreach($row as $rows) {
                         echo $rows->core->member_login_name;
                         echo $rows->attendances->att_date;
                     }
                     exit;*/
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
         
         $select = "SELECT * FROM core_member JOIN attendances ON core_member.member_id=attendances.member_id";
         $conditions=$this->setCondition($year, $month, $username);
              $sql = $select;
              if (count($conditions) > 0) {
              $sql .= " WHERE " . implode(' AND ', $conditions);
              }
             
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

              if ($year) {
              $conditions[] = "YEAR(attendances.att_date) like " . $year;
              }
              if ($month) {
              $conditions[] = "MONTH(attendances.att_date) like " . $month;
              }
              if ($username) {
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
        $query = "Select member_id from core_member where member_id NOT IN (Select member_id from attendances where att_date = CURRENT_DATE)  AND deleted_flag=0";
        $res   = $this->db->query($query);
        $absent = $res->fetchall();        
        foreach ($absent as $v){
            $insert = "Insert into absent (member_id,date,delete_flag) VALUES ('".$v[0]."',CURRENT_DATE,1)";
            $this->db->query($insert);
        }
    }
    
    public function GetAbsentList(){
        
        $query = "Select * from core_member where member_id NOT IN (Select member_id from attendances where att_date = CURRENT_DATE) AND deleted_flag=0";    
        $list=$this->db->query($query);
         $absentlist=$list->fetchall();
         return $absentlist;
        
    }
}
