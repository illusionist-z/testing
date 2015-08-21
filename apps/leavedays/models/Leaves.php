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


        $select = "SELECT date(date) as date,member_login_name,date(start_date) as start_date, date(end_date) as end_date,leave_days,leave_category,leave_description,leave_status FROM leaves JOIN core_member ON leaves.member_id=core_member.member_id ";
        $conditions = array();

        if ($ltype != "") {
            $conditions[] = "leaves.leave_category='" . $year . "'";
        }
        if ($month != "") {
            $conditions[] = "MONTH(leaves.start_date) like " . $month;
        }
        if ($namelist != "") {
            $conditions[] = "core_member.member_login_name='" . $namelist . "'";
        }

        $sql = $select;
        if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
        //echo $sql;exit;
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
        
        $ldata = $this->db->query("SELECT total_leavedays FROM leaves  WHERE leaves.member_id='".$uname."' AND  start_date BETWEEN '" . $date['startDate'] . "' AND  '" .  $date['endDate']. "' ORDER BY start_date DESC LIMIT 1 ");
        $list = $ldata->fetchall();
        if($list==NULL){
           $lastdata=NULL;
        }
        else{
            $lastdata=($list['0']['total_leavedays']);
        }
       
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
                        $result = $this->db->query("INSERT INTO leaves (member_id,date,start_date,end_date,leave_days,leave_category,leave_description,total_leavedays,leave_status,creator_id,created_dt) VALUES('" . $uname . "','" . $today . "','" . $sdate . "','" . $edate . "','" . $leave_day . "','" . $type . "','" . $desc . "','" . $lastdata . "',0,'".$uname."',now())");
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
        
        $credt = $this->db->query("SELECT created_dt,updated_dt FROM core_member  WHERE core_member.member_id= '" . $id . "'");
        $created_date = $credt->fetchall();

       
        $this->updatecontract($created_date);
        if( $created_date['0']['updated_dt']!='0000-00-00 00:00:00' OR null ){
            $date['startDate']=$created_date['0']['updated_dt'];
            $date['endDate']=date('Y-m-d', strtotime("+1 year", strtotime($created_date['0']['updated_dt'])));
        }
        else{
            $date['startDate']=$created_date['0']['created_dt'];
            $date['endDate']=date('Y-m-d', strtotime("+1 year", strtotime($created_date['0']['created_dt'])));
        }
      //        $date['endDate']=date('Y-m-d', strtotime("+1 year", strtotime())); 
//        if($date['endDate']==date("Y-m-d H:i:s")){
//            $this->updatecorememberdate($date['endDate'], $id);
//        }
//       
////        if( $created_date['0']['updated_dt']!='0000-00-00 00:00:00'){
////            $date['startDate']=$created_date['0']['updated_dt'];
////            $date['endDate']=date('Y-m-d', strtotime("+1 year", strtotime($created_date['0']['updated_dt'])));
////             
////        }
        
        
        return $date;
    }
    public function updatecontract($created_date){
       
        if( $created_date['0']['updated_dt']!=null){
             $date['startDate']=$created_date['0']['updated_dt'];
             
             
        }
        else{$date['startDate']=$created_date['0']['created_dt'];
      
        }
       
        $date['endDate']=date('Y-m-d', strtotime("+1 year", strtotime($date['startDate']))); 
        if($date['endDate']==date("Y-m-d H:i:s")){
            $this->updatecorememberdate($date['endDate'], $id);
        }
        
       return $date;

    }
    
    public function updatecorememberdate($date,$id){
           $this->db->query("UPDATE core_member set core_member.updated_dt='" . $date . "'  WHERE core_member.member_id= '" . $id . "'");

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
            //showing current month leave list
            $row = $this->modelsManager->createBuilder()
                    ->columns('date,start_date,member_login_name,end_date,leave_category,leave_status,leave_days,leave_description,total_leavedays')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Leavedays\Models\Leaves', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Leavedays\Models\Leaves.member_id ')
                    ->where('MONTH( workManagiment\Leavedays\Models\Leaves.start_date) ="' . $mth . '" AND  workManagiment\Leavedays\Models\Leaves.member_id ="' . $id . '"')
                    ->getQuery()
                    ->execute();
           
        } else {
            //for searching by leave type and month
           
            $row = $this->modelsManager->createBuilder()
                    ->columns('date,start_date,member_login_name,end_date,leave_category,leave_status,leave_days,leave_description,total_leavedays')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Leavedays\Models\Leaves', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Leavedays\Models\Leaves.member_id ')
                    ->where($this->setCondition2($mth, $leave_type) . ' AND workManagiment\Leavedays\Models\Leaves.member_id =' . "'$id'")
                    ->getQuery()
                    ->execute();
           
        }
        //for pagination
        $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 1,
            "page" => $currentPage
                )
        );
        $list = $paginator->getPaginate();
        
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

            $conditions[] = "MONTH(workManagiment\Leavedays\Models\Leaves.start_date) like " . $month;
        }
        if ($leavetype != "") {
            $conditions[] = "workManagiment\Leavedays\Models\Leaves.leave_category='" . $leavetype . "'";
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
        $this->db->query("UPDATE leaves set leaves.leave_status=1  WHERE leaves.member_id='".$id."' AND leaves.start_date='".$sdate."'");
        $stt=1;
        $this->updateleavedata($id,$sdate,$edate,$days,$stt);
    }
    /**
     * 
     * @param type $id
     * @param type $sdate
     * change leave status to '2'
     * when admin reject leavedays request from user
     */
    public function rejectleave($id,$sdate,$edate,$days){
        $this->db = $this->getDI()->getShared("db");
        $sql = "UPDATE leaves set leaves.leave_status=2 WHERE leaves.member_id='".$id."' AND leaves.start_date='".$sdate."'";
        $this->db->query($sql);
        
        
        

    }
    
    public function updateleavedata($id,$sdate,$edate,$days,$stt){
        
        $date=$this->getcontractdata($id);
//        print_r($date);exit;
        $datePeriod =$this->GetDays($sdate, $edate);
        $length=count($datePeriod);
        
        for($i=0;$i<($length-1);$i++){
            
            $this->db->query("INSERT INTO absent (member_id,date,status) VALUES('" . $id . "','" . $datePeriod[$i] . "','" . $stt . "')");
        }
       
       $this->db->query("UPDATE leaves set leaves.total_leavedays=total_leavedays+'".$days."' WHERE leaves.member_id='".$id."'  AND date BETWEEN '" . $date['startDate'] . "' AND  '" .  $date['endDate']. "'");

    }
    
     public function getleavesetting(){
          $row = $this->modelsManager->createBuilder()
                    ->columns('max_leavedays,fine_amount')
                    ->from('workManagiment\Leavedays\Models\LeavesSetting')
                    ->getQuery()
                    ->execute();
        
     return $row;}
    
    
    
    
  
}
