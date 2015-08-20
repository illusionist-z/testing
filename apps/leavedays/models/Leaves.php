<?php

namespace workManagiment\Leavedays\Models;

use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use workManagiment\Leavedays\Models\LeavesSetting;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Leaves extends \Library\Core\BaseModel {

    public function initialize() {
        parent::initialize();
    }

    /**
     * 
     * @param type $leave_type
     * @param type $mth
     * @param type $username
     * @return type
     */
    public function getleavelist() {
        //select leave list
        $this->db = $this->getDI()->getShared("db");

        $sql = "SELECT * FROM leaves JOIN core_member ON leaves.member_id=core_member.member_id";
        $result = $this->db->query($sql);
        $row = $result->fetchall();
        return $row;
  
    }

    /**
     * Search for leave list
     * @param type $ltype
     * @param type $month
     * @param type $namelist
     * @return type
     */
    public function search($ltype, $month, $namelist) {
        $this->db = $this->getDI()->getShared("db");
        
        $select = "SELECT date(date) as date,member_login_name,date(start_date) as start_date, date(end_date) as end_date,leave_days,leave_category,leave_description,leave_status,total_leavedays FROM leaves JOIN core_member ON leaves.member_id=core_member.member_id ";
        $conditions = array();

        if ($ltype != "") {
            $conditions[] = "leaves.leave_category='" . $ltype . "'";
        }
        if ($month != "") {
            $conditions[] = "MONTH(leaves.start_date) = '" . $month. "'";
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
     * @author david
     */
    public function applyleave($uname, $sdate, $edate, $type, $desc) {

        $this->db = $this->getDI()->getShared("db");
        $date=$this->getcontractdata($uname);
        
        
         $ldata = $this->db->query("SELECT total_leavedays FROM leaves  WHERE leaves.member_id= '" . $uname . "' AND date BETWEEN '" . $date['startDate'] . "' AND  '" .  $date['endDate']. "' ORDER BY date DESC LIMIT 1 ");
         $list = $ldata->fetchall();
        
         if($list==NULL){
         $lastdata="0";}
             else{$lastdata=($list['0']['total_leavedays']);}
         if ($sdate != NULL && $edate != NULL && $desc != NULL) {
            
            if (isset($sdate) AND isset($edate) AND isset($desc)) {
              
                $today = date("Y-m-d H:i:s");
                $checkday = date("Y-m-d", strtotime("+7 days"));
                $sdate = date("Y-m-d", strtotime($sdate));
                $edate = date("Y-m-d", strtotime($edate));
                //check before a week
                if ($sdate >= $checkday && $edate >= $checkday) {
                    //check $edate greater than $sdate
                    if (strtotime($sdate) <= strtotime($edate)) {
                        $leave_day = (strtotime($edate) - strtotime($sdate)) / 86400;   //for calculate leave day             
                        $result = $this->db->query("INSERT INTO leaves (member_id,date,start_date,end_date,leave_days,leave_category,leave_description,total_leavedays,leave_status,creator_id,created_dt) VALUES('" . $uname . "','" . $today . "','" . $sdate . "','" . $edate . "','" . $leave_day . "','" . $type . "','" . $desc . "','" . $lastdata . "',0,'".$this->session->user['member_id']."',now())");
                        $err="Your Leave Applied Successfully!";
                    } else {
                        $err="End date must be greater than Start date";
                    }
                } else {
                        $err="Apply Leave Before a week ";                 
                }
            }
        } else {
                        $err="Please,Insert All Data! ";            
        }
        return $err;
    }
    
/**
 * get list of dates between two dates
 * @author Su Zin Kyaw
 * @param type $StartDate
 * @param type $EndDate
 * @return string
 */
public  function GetDays($StartDate, $EndDate){  
    $date_ffrom = $StartDate;   
    $date_from = strtotime($date_ffrom); // Convert date to a UNIX timestamp  
  
// Specify the end date. This date can be any English textual format  
    $date_tto = $EndDate;  
    $date_to = strtotime($date_tto); // Convert date to a UNIX timestamp  
  
// Loop from the start date to end date and output all dates inbetween  
    for ($i=$date_from; $i<=$date_to; $i+=86400) {  
    $date[]= date("Y-m-d", $i).'<br />'; 
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
    public function getcontractdata($id){
        $credt = $this->db->query("SELECT created_dt,updated_dt FROM salary_master  WHERE salary_master.member_id= '" . $id . "'");
        $created_date = $credt->fetchall();
        if( $created_date['0']['updated_dt']=='0000-00-00 00:00:00'){
             $date['startDate']=$created_date['0']['created_dt'];
             $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date['0']['created_dt'])));
        }
        else{
             $date['startDate']=$created_date['0']['updated_dt'];
            $date['endDate']=date('Y-m-d', strtotime("+1 year", strtotime($created_date['0']['updated_dt'])));
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

        $this->db = $this->getDI()->getShared("db");
        if ($leave_type == null and $mth == null) {
            $mth = date('m');
            $row ="select date,start_date,member_login_name,end_date,leave_category,leave_status,leave_days,leave_description,total_leavedays from core_member left join leaves on core_member.member_id = leaves.member_id where month(leaves.start_date)='".$mth."' AND leaves.member_id ='".$id."'";          
           
        } else {
            //for searching by leave type and month           
            $row ="select date,start_date,member_login_name,end_date,leave_category,leave_status,leave_days,leave_description,total_leavedays from core_member left join leaves on core_member.member_id = leaves.member_id where ".$this->setCondition2($mth, $leave_type)."  AND leaves.member_id ='".$id."'";                               
        }
        $result = $this->db->query($row);
        $list   = $result->fetchall();               
        return $list;
    }
    
    /**
     * set conditon for more than one condition
     * @param type $month
     * @param type $leavetype
     * @return string
     */
    public function setCondition2( $month, $leavetype) {
        $conditions = array();


        if ($month != "") {

            $conditions[] = "MONTH(leaves.start_date) ='" . $month ."'";
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
    public function acceptleave($id,$sdate,$edate,$days){
        $this->db = $this->getDI()->getShared("db");
        $date=$this->getcontractdata($id);
        $datePeriod =$this->GetDays($sdate, $edate);
        $length=count($datePeriod);
        $ldata = $this->db->query("SELECT total_leavedays FROM leaves  WHERE leaves.member_id= '" . $id . "' AND date BETWEEN '" . $date['startDate'] . "' AND  '" .  $date['endDate']. "' ORDER BY date DESC LIMIT 1 ");
        $list = $ldata->fetchall();
       
        $max=$this->getleavesetting();
       
        if($list['0']['total_leavedays']>=$max['0']['max_leavedays']){
             $stt=2;
        }
        else{
             $stt=1;
        }
        for($i=0;$i<($length-1);$i++){
            echo $datePeriod[$i] ;echo $i;
            $this->db->query("INSERT INTO absent (member_id,date,status) VALUES('" . $id . "','" . $datePeriod[$i] . "','" . $stt . "')");
        }
        $status=1;
        $this->db->query("UPDATE leaves set leaves.leave_status='".$status."'  WHERE leaves.member_id='".$id."' AND leaves.start_date='".$sdate."'");
        $this->db->query("UPDATE leaves set leaves.total_leavedays=total_leavedays+'".$days."' WHERE leaves.member_id='".$id."'  AND date BETWEEN '" . $date['startDate'] . "' AND  '" .  $date['endDate']. "'");

    }
   
    /**
     * 
     * @param type $id
     * @param type $sdate
     * change leave status to '2'
     * when admin reject leavedays request from user
     */
    public function rejectleave($id,$sdate){
        $this->db = $this->getDI()->getShared("db");
        $sql = "UPDATE leaves set leaves.leave_status=2 WHERE leaves.member_id='".$id."' AND leaves.start_date='".$sdate."'";
       $this->db->query($sql);
    }
    
    
     public function getleavesetting(){
          $row = $this->modelsManager->createBuilder()
                    ->columns('max_leavedays,fine_amount')
                    ->from('workManagiment\Leavedays\Models\LeavesSetting')
                    ->getQuery()
                    ->execute();
        
     return $row;}
    
    
    
    
  
}
