<?php
namespace workManagiment\Attendancelist\Models;
use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
//use workManagiment\Attendancelist\Models\CoreMember as CoreMember;
//use workManagiment\Attendancelist\Models\Attendances as Attendances;

//use workManagiment\Auth\Models\Db\CoreMember as corememberresult;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendances extends Model {

    /**
     * Get today attendance list
     * @return type
     * @author zinmon
     */
  
    public function gettodaylist($name) {
        $this->db = $this->getDI()->getShared("db");
        $today = date("Y:m:d");
        // for search result
        if (isset($name)) {
             $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Attendancelist\Models\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Attendancelist\Models\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('workManagiment\Attendancelist\Models\CoreMember.member_login_name) =' . $name .' AND workManagiment\Attendancelist\Models\Attendances.att_date =' . "'$today'" )
                    ->getQuery()
                    ->execute();
        } else {
            //show att today list
            $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Attendancelist\Models\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Attendancelist\Models\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where(' workManagiment\Attendancelist\Models\Attendances.att_date =' . "'$today'" )
                    ->getQuery()
                    ->execute();
        }
         $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 1,
            "page" => $currentPage
                )
        );
        $list = $paginator->getPaginate();
        //print_r($list);exit;
        return $list;
    }
    
    /**
     * Get user name
     * @return type
     * @author zinmon
     */
    public function getusername() {
        $this->db = $this->getDI()->getShared("db");
        $user_name = $this->db->query("SELECT * FROM core_member");
        //print_r($user_name);exit;
        $getname = $user_name->fetchall();
        return $getname;
    }
    /**
    *get Attendance List By User ID 
    *@author Su Zin Kyaw
    */
 
    public function getattlist($id,$month){
       $this->db = $this->getDI()->getShared("db");
        $currentmth = date('m');
     
       if (isset($month)) {
              $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Attendancelist\Models\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Attendancelist\Models\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $month .' AND workManagiment\Attendancelist\Models\Attendances.member_id =' . "'$id'" )
                    ->getQuery()
                    ->execute();
       
        
    }
    else{
            $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Attendancelist\Models\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Attendancelist\Models\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $currentmth .' AND workManagiment\Attendancelist\Models\Attendances.member_id =' . "'$id'" )
                    ->getQuery()
                    ->execute();
            
    }
     $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 1,
            "page" => $currentPage
                )
        );
        $list = $paginator->getPaginate();
        //print_r($list);exit;
        return $list;
    }
    
    public function getattlistbyMonth($id,$month,$year){

       $this->db = $this->getDI()->getShared("db");
        //search monthly list data
        
        if (!isset($year) and ! isset($month)) {
            
            $month = date('m');
            $results = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time')
                    ->from('CoreMember')
                    ->leftJoin('Attendances', 'CoreMember.member_id = Attendances.member_id ')
                    ->where('MONTH(Attendances.att_date) =' . $month .' AND Attendances.member_id =' . "'$id'" )
                    ->getQuery()
                    ->execute();
            
        } else {
          if($year==0 AND $month ==0){
              echo '<script type="text/javascript">alert("Select Option to search! ")</script>';
                  echo "<script>window.location.href='attendances';</script>";
          }

           $results = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time')
                    ->from('CoreMember')
                    ->leftJoin('Attendances', 'CoreMember.member_id = Attendances.member_id ')
                    ->where($this->setCondition2($year, $month) .' AND Attendances.member_id =' . "'$id'")
                    ->getQuery()
                    ->execute();
        }
            $currentPage = (int) $_GET["page"];
        // Create a Model paginator, show 10 rows by page starting from $currentPage
        $paginator = new PaginatorModel(
                array(
            "data" => $results,
            "limit" => 5,
            "page" => $currentPage
                )
        );
        $list = $paginator->getPaginate();
        return $list;
    }
    
 
     public function setCondition2($year, $month) {
        $conditions = array();

        if ($year != "") {
            //echo $year;exit;
            $conditions[] = "YEAR(Attendances.att_date) like " . $year;
        }
        if ($month != "") {
            $conditions[] = "MONTH(Attendances.att_date) like " . $month;
        }
       

        //$sql = $select;
        if (count($conditions) > 0) {
            $result = implode(' AND ', $conditions);
        } else {
            $result = $conditions;
        }
       
        return $result;
 }
    

}
