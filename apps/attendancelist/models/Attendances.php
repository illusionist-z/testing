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
            $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('workManagiment\Core\Models\Db\CoreMember.member_login_name ="'.$name.'" AND workManagiment\Attendancelist\Models\Attendances.att_date ="' .$today.'"')
                    ->getQuery()
                    ->execute();
        } else {
            //show att today list
            $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where(' workManagiment\Attendancelist\Models\Attendances.att_date =' . "'$today'")
                    ->getQuery()
                    ->execute();
        }
        
        //for paging 
        $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 1,//outputing 1 data per page
            "page" => $currentPage
                )
        );
        $list = $paginator->getPaginate();
        
        return $list;
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
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
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
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
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
            "limit" => 1,
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
            $results = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $month)
                    ->orderBy('workManagiment\Attendancelist\Models\Attendances.att_date DESC')
                    ->getQuery()
                    ->execute();
        
        //for paging
        $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $results,
            "limit" => 10,
            "page" => $currentPage
                )
        );
        $list = $paginator->getPaginate();
        return $list;
    }

    public function search_attlist($year,$month,$username) {
        try {
        $sql = "SELECT * FROM core_member JOIN attendances ON attendances.member_id=core_member.member_id where MONTH(attendances.att_date)='".$month."'";
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

        if ("" != $year) {
            //echo 'Y'.$year;exit;
            $conditions[] = "YEAR(workManagiment\Attendancelist\Models\Attendances.att_date) like " . $year;
        }
        if ("" != $month) {
           
            $conditions[] = "MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) like " . $month;
        }
        if ("" != $username) {
            //echo 'Uname'.$username;exit;
            $conditions[] = "workManagiment\Core\Models\Db\CoreMember.member_login_name='" . $username . "'";
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
