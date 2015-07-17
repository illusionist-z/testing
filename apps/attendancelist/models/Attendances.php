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
     * get Attendance List By User ID 
     * @author Su Zin Kyaw
     */
    public function getattlist($id, $month) {
        $this->db = $this->getDI()->getShared("db");
        $currentmth = date('m');

        if (isset($month)) {
            $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $month . ' AND workManagiment\Attendancelist\Models\Attendances.member_id =' . "'$id'")
                    ->getQuery()
                    ->execute();
        } else {
            $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $currentmth . ' AND workManagiment\Attendancelist\Models\Attendances.member_id =' . "'$id'")
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
     * Show monthly attendance list
     * @param type $year
     * @param type $month
     * @param type $username
     * @return type
     * @author zinmon
     */
    public function showmonthlylist($year, $month, $username) {

        $this->db = $this->getDI()->getShared("db");
        //search monthly list data

        if ($year == "" and $month == "" and $username == "") {
            $month = date('m');
//            $result = $this->db->query("SELECT * FROM core_member JOIN attendances ON core_member.member_id=attendances.member_id WHERE MONTH(attendances.att_date)='" . $month . "'");
//            $list = $result->fetchall();
            $results = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $month)
                    ->getQuery()
                    ->execute();
        } else {
     
            $results = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    //if (count($conditions) > 0) 
                    //{
                    ->where($this->setCondition($year, $month, $username))

                    // }
                    ->getQuery()
                    ->execute();
        }

        $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $results,
            "limit" => 1,
            "page" => $currentPage
                )
        );
        $list = $paginator->getPaginate();
        //print_r($list);exit;
        return $list;
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
            //echo $year;exit;
            $conditions[] = "YEAR(workManagiment\Attendancelist\Models\Attendances.att_date) like " . $year;
        }
        if ($month != "") {

            $conditions[] = "MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) like " . $month;
        }
        if ($username != "") {
            $conditions[] = "workManagiment\Core\Models\Db\CoreMember.member_login_name='" . $username . "'";
        }

        //$sql = $select;
        if (count($conditions) > 0) {
            $result = implode(' AND ', $conditions);
            //echo $result;exit;
        } else {
            $result = $conditions;
        }
        //print_r($result);exit;
        return $result;
    }


}
