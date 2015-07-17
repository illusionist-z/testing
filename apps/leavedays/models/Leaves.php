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
    }

    /**
     * Get today attendance list
     * @return type
     * @author suzin
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
                    ->where('MONTH( workManagiment\Leavedays\Models\Leaves.start_date) ="' . $mth . '" AND  workManagiment\Leavedays\Models\Leaves.leave_category ="' . $leave_type . '" AND  workManagiment\Leavedays\Models\Leaves.member_id ="' . $id . '"')
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

}
