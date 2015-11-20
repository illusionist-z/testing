<?php

namespace workManagiment\Leavedays\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LeaveCategories extends \Library\Core\BaseModel {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public function getleavetype() {

        $sql = "SELECT * FROM leave_categories  order by created_dt desc";
        $results = $this->db->query($sql);
        $typelist = $results->fetchall();
        return $typelist;
    }

    public function getltypedata($id) {


        $results = $this->db->query("SELECT * FROM leave_categories WHERE leavetype_id='" . $id . "'");

        $data = $results->fetchall();
        return $data;
    }

    public function delete_categories($id) {
        $this->db->query("DELETE FROM leave_categories WHERE leavetype_id='" . $id . "'");
    }

    public function add_newcategories($ltype_name) {
        $this->db->query("INSERT INTO leave_categories(leavetype_id,leavetype_name,created_dt) VALUES (uuid(),'" . $ltype_name . "',now() )");
    }
    /**
     *
     *  type get $member_id
     */
    public function memidapplyleave($uname) {
        
            //$sql = "select salary_master.member_id from salary_master LEFT JOIN core_member ON salary_master.member_id=core_member.member_id WHERE core_member.full_name ='".$uname."'";
            $sql = "select * from core_member WHERE full_name ='".$uname."'";
           // print_r($sql);exit;
            $result = $this->db->query($sql);
            $row = $result->fetchall();
           //print_r($row);exit;
        
        return $row;
    }

}
