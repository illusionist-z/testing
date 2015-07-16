<?php namespace workManagiment\Leavedays\Models;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Leaves extends \Library\Core\BaseModel{
    
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
    public function getleavelist($leave_type, $mth, $username) {
        //select leave list
        $this->db = $this->getDI()->getShared("db");
        if (!isset($leave_type) and ! isset($mth) and ! isset($username)) {
            $sql = "SELECT * FROM leaves JOIN core_member ON leaves.member_id=core_member.member_id";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
          
        } else {
            //search leave list
           
        }
       
        return $row;
    }
    
      public function getuserleavelist($leave_type, $mth) {
        //select leave list
        $this->db = $this->getDI()->getShared("db");
        if (!isset($leave_type) and ! isset($mth) and ! isset($username)) {
            $sql = "SELECT * FROM leaves JOIN core_member ON leaves.member_id=core_member.member_id";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
          
        } else {
            //search leave list
           
        }
       
        return $row;
    }
    
   
}