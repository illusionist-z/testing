<?php

namespace workManagiment\Leavedays\Models;

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

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
        
//        $row = $this->modelsManager->createBuilder()
//                    ->columns('date,member_login_name,start_date,end_date,leave_days,leave_category,leave_description,leave_status')
//                    ->from('workManagiment\Leavedays\Models\Leaves')
//                    ->leftJoin('workManagiment\Core\Models\Db\CoreMember', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Leavedays\Models\Leaves.member_id ')
//                    ->getQuery()
//                    ->execute();
//        $currentPage = (int) $_GET["page"];
//        $paginator = new PaginatorModel(
//                array(
//            "data" => $row,
//            "limit" => 1,
//            "page" => $currentPage
//                )
//        );
//        $list = $paginator->getPaginate();
//        return $list;
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
//        $sql = "SELECT * FROM leaves JOIN core_member ON leaves.member_id=core_member.member_id where MONTH(leaves.start_date)='".$month."'";
//        $result = $this->db->query($sql);
//        $row = $result->fetchall();

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
//        
//        $row = $this->modelsManager->createBuilder()
//                    ->columns('date,member_login_name,start_date,end_date,leave_days,leave_category,leave_description,leave_status')
//                    ->from('workManagiment\Leavedays\Models\Leaves')
//                    ->leftJoin('workManagiment\Core\Models\Db\CoreMember', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Leavedays\Models\Leaves.member_id ')
//                    ->where($this->condition($ltype,$month,$namelist))
//                    ->getQuery()
//                    ->execute();
        //print_r($row);exit;
        return $list;
    }
    
//    public function condition($ltype, $month, $namelist){
//        $conditions = array();
//
//        if ($ltype != "") {
//            $conditions[] = "leaves.leave_category='" . $year . "'";
//        }
//        if ($month != "") {
//            $conditions[] = "MONTH(leaves.start_date) like " . $month;
//        }
//        if ($namelist != "") {
//            $conditions[] = "core_member.member_login_name='" . $namelist . "'";
//        }
//
//        return $condition;
//    }

    /**
     * Get today attendance list
     * @return type
     * @author david
     */
    public function applyleave($id, $sdate, $edate, $type, $desc) {

        $this->db = $this->getDI()->getShared("db");
        if ($sdate != NULL && $edate != NULL && $desc != NULL) {

            if (isset($sdate) AND isset($edate) AND isset($desc)) {
                $today = date("Y-m-d");
                $checkday = date("Y-m-d", strtotime("+7 days"));
                $sdate = date("Y-m-d", strtotime($sdate));
                $edate = date("Y-m-d", strtotime($edate));
                //check before a week
                if ($sdate >= $checkday && $edate >= $checkday) {
                    //check $edate greater than $sdate
                    if (strtotime($sdate) < strtotime($edate)) {
                        $leave_day = (strtotime($edate) - strtotime($sdate)) / 86400;   //for calculate leave day             
                        $result = $this->db->query("INSERT INTO leaves (member_id,date,start_date,end_date,leave_days,leave_category,leave_description) VALUES('" . $id . "','" . $today . "','" . $sdate . "','" . $edate . "','" . $leave_day . "','" . $type . "','" . $desc . "')");
                        echo '<script type="text/javascript">alert("Your Leave Applied Successfully! ")</script>';
                    } else {
                        echo '<script>alert("End date must be greater than Start date");</script>';
                    }
                } else {
                    echo '<script type="text/javascript">alert("Apply Leave Before a week ")</script>';
                    //echo "<script>window.location.href='applyleave';</script>";exit;
                }
            }
        } else {
            echo '<script type="text/javascript">alert("Please,Insert All Data! ")</script>';
            // echo "<script>window.location.href='applyleave';</script>";exit;
        }
    }

    public function getuserleavelist($leave_type, $mth, $id) {
        //select leave list

        $this->db = $this->getDI()->getShared("db");
        if ($leave_type == null and $mth == null) {
            $mth = date('m');
            $row = $this->modelsManager->createBuilder()
                    ->columns('date,start_date,member_login_name,end_date,leave_category,leave_status,leave_days,leave_description')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Leavedays\Models\Leaves', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Leavedays\Models\Leaves.member_id ')
                    ->where('MONTH( workManagiment\Leavedays\Models\Leaves.start_date) ="' . $mth . '" AND  workManagiment\Leavedays\Models\Leaves.member_id ="' . $id . '"')
                    ->getQuery()
                    ->execute();
        } else {

            $row = $this->modelsManager->createBuilder()
                    ->columns('date,start_date,member_login_name,end_date,leave_category,leave_status,leave_days,leave_description')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Leavedays\Models\Leaves', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Leavedays\Models\Leaves.member_id ')
                    ->where($this->setCondition2($mth, $leave_type) . ' AND workManagiment\Leavedays\Models\Leaves.member_id =' . "'$id'")
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

        return $list;
    }

    public function setCondition2($month, $leavetype) {
        $conditions = array();


        if ($month != "") {

            $conditions[] = "MONTH(workManagiment\Leavedays\Models\Leaves.start_date) like " . $month;
        }
        if ($leavetype != "") {
            $conditions[] = "workManagiment\Leavedays\Models\Leaves.leave_category='" . $leavetype . "'";
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
