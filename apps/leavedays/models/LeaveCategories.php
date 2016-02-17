<?php

namespace salts\Leavedays\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LeaveCategories extends \Library\Core\Models\Base {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public function getLeaveType() {
   $leave_cate =  $this->modelsManager->createBuilder()
                           ->columns("*")
                           ->from("salts\LeaveDays\Models\LeaveCategories")
                           ->orderBy("salts\LeaveDays\Models\LeaveCategories.created_dt desc")
                           ->getQuery()
                           ->execute();
        $typelist = $leave_cate->toArray();        
        return $typelist;
    }

    public function getListTypeData($id) {
        $leave_cate = LeaveCategories::find("leavetype_id ='$id'");
        $results = \salts\Core\Models\Permission::tableObject($leave_cate);
        $data = $results->toArray();
        return $data;
    }

    public function deleteCategories($id) {
        $delete_cate = LeaveCategories::find("leavetype_id ='$id'");
        $delete_cate_row = \salts\Core\Models\Permission::tableObject($delete_cate);
        $delete_cate_row->delete();        
    }

    public function addNewCategories($ltype_name) {
        $psql = "INSERT INTO salts\LeaveDays\Models\LeaveCategories (leavetype_id,leavetype_name,created_dt) VALUES (uuid(),'" . $ltype_name . "',now() )";
        $this->modelsManager->executeQuery($psql);
    }

    /**
     *
     *  type get $member_id
     */
    public function memberIdApplyLeave($uname) {
        $core_member = \salts\Core\Models\Db\CoreMember::findByMemberLoginName($uname);
        $row = $core_member->toArray();        
        return $row;
    }

}
