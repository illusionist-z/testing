<?php

namespace salts\Attendancelist\Models;
use DateTime;
use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

use salts\Core\Models\Db\CoreMember as CoreMember;
use salts\Attendancelist\Models\Attendances as Attendances;

         use Phalcon\Filter; 
//use salts\Auth\Models\Db\CoreMember as corememberresult;
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
        
        
        if(isset($name)){
           $row =   $this->modelsManager->createBuilder()
                         ->columns(array('core.*', 'attendances.*'))
                         ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                         ->join('salts\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                         ->where('core.member_login_name = :name:', array('name' => $name))
                         ->andWhere('attendances.att_date = :today:', array('today' => $today))
                         ->andWhere('core.deleted_flag = 0') 
                         ->getQuery()
                         ->execute();          
         
           
           
                    
        }else{
            $row =   $this->modelsManager->createBuilder()
                          ->columns(array('core.*', 'attendances.*'))
                          ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                          ->join('salts\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                          ->where('attendances.att_date = :today:', array('today' => $today))
                          ->andWhere('core.deleted_flag = 0')
                          ->orderBy('attendances.checkin_time DESC')
                          ->getQuery()
                          ->execute(); 
            
        }
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
    public function getattlist($id,$year,$month) {        
        $currentmth = date('m');
        
        
        if(isset($year) || isset($month)){
           $start =  date("Y-m-d",strtotime($year));
           $end =  date("Y-m-d",strtotime($month));
           $row =   $this->modelsManager->createBuilder()
                         ->columns(array('core.*', 'attendances.*'))
                         ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                         ->join('salts\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                         ->where('attendances.att_date >= :start:', array('start' => $start))
                         ->andWhere('attendances.att_date <= :end:', array('end' => $end))
                         ->andWhere('attendances.member_id = :id:', array('id' => $id))
                         ->andWhere('core.deleted_flag = 0')                        
                         ->getQuery()
                         ->execute();          
                
                    
        }else{
            
            $row =   $this->modelsManager->createBuilder()
                         ->columns(array('core.*', 'attendances.*'))
                         ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                         ->join('salts\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                         ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                         ->andWhere('attendances.member_id = :id:', array('id' => $id))
                          ->andWhere('core.deleted_flag = 0')
                         ->orderBy('attendances.att_date DESC')
                         ->getQuery()
                         ->execute();           
               
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
           
            
            $row = $this->modelsManager->createBuilder()               
                        ->columns(array('core.*', 'attendances.*'))                
                        ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                        ->join('salts\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                        ->where('MONTH(attendances.att_date) = :month: ', array('month' => $month))
                        ->andWhere('core.deleted_flag = 0')
                        ->orderBy('attendances.checkin_time DESC')
                        ->getQuery()
                        ->execute();           
                
              return $row;
    }
    
 
    /**
     * @desc   insert absent member to absent 
     * @author David
     * @param  $v[0] = member_id
     */
      public function absent($id) {
        $sql = "Select member_id,date from absent where member_id='" . $id . "' and date=CURRENT_DATE";
        $absentlist = $this->db->query($sql);
        $finalresult = $absentlist->fetchall();
        
        if ($finalresult == null) {
            $insert = "Insert into absent (member_id,date,deleted_flag) VALUES ('" . $id . "',CURRENT_DATE,1)";
            $this->db->query($insert);
            $message = "Adding is successfully";
        } 
        else {
            $message = "Already Exit";
        }
        // print_r($message);exit;       
        return $message;
    }
    
    public function GetAbsentList(){
         $query = "Select * from core_member where member_id NOT IN (Select member_id from attendances where att_date = CURRENT_DATE) AND deleted_flag=0 order by created_dt desc";
        $list=$this->db->query($query);
         $absentlist=$list->fetchall();
         return $absentlist;
    }
    public function getAttTime($id) {
        $query = "select * from core_member JOIN attendances On core_member.member_id = attendances.member_id Where attendances.id ='".$id."' ";
       
        $data = $this->db->query($query);
        $result = $data->fetchall();
        // print_r($result);exit;
        return $result;
    }
    public function editAtt($data,$id,$offset) {
        //print_r($data);exit;
        
        $localtime=$this->LocalToUTC($data,$offset);
        //echo $localtime;
        $query = "update attendances set checkin_time='".$localtime."' where id='".$id."'";
        $this->db->query($query);
    }
    
    public function LocalToUTC($data,$offset){
        
        if ($offset<0){
           //$sign='-';
           $value=$offset;
           $localtime = date("Y-m-d H:i:s",strtotime($value." minutes",strtotime($data)));
           
        }
        else{
           $value=$offset;
           $localtime = date("Y-m-d H:i:s",strtotime($value." minutes",strtotime($data)));
           //$sign='+';
//           $localtime = new DateTime($data);
//           $localtime->add(new DateInterval('PT' . $value . 'M'));
//           $localtime=$localtime->format('y-m-d H:i:s');echo '+';
           
        } 
        return $localtime;
        
    }
    
     public function search_attlist($year,$month,$username) {
       
        try {
         
         $select = "SELECT * FROM core_member JOIN attendances ON core_member.member_id=attendances.member_id ";
         $conditions=$this->setCondition($year, $month, $username);
              $sql = $select;
              if (count($conditions) > 0) {
              $sql .= " WHERE " . implode(' AND ', $conditions)." AND core_member.deleted_flag = 0";
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

              if ($year) {
                  $start =  date("Y-m-d",strtotime($year));
              $conditions[] = "attendances.att_date >=  ' " . $start . " ' ";
              }
              if ($month) {
                   $end =  date("Y-m-d",strtotime($month));
              $conditions[] = "attendances.att_date <=  ' " . $end . " ' ";
              }
              if ($username) {
              $conditions[] = "member_login_name ='" . $username . "'";
              }
               
        return $conditions;
    }
}
