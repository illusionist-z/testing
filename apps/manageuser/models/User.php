<?php

namespace workManagiment\Manageuser\Models;

use Phalcon\Mvc\Model;
use workManagiment\Core\Models\Db;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Model {

    /**
     * Get member user list
     * @return type
     * @author david
     * 
     */
    public function userlist() {
        $user = new Db\CoreMember();
        $userlist = $user::getinstance()->getusername();
        return $userlist;
    }
    /**
     * get data by name
     * @return type
     * @author david
     */
    public function useredit($name){
        $user = Db\CoreMember::findByMemberLoginName($name);
        return $user;
    }
    /**
     * @since  20/7/15
     * @author David
     * @desc  edit by cond
     * @param type $cond {array}
     */
    public function editbycond($cond){
        $this->db = $this->getDI()->getShared("db");        
        $query = "Update core_member SET member_login_name='".$cond['name']."',member_dept_name='".$cond['dept']."',member_tel='".$cond['pno']."',member_mail='".$cond['email']."',job_title='".$cond['position']."' Where member_id='".$cond['id']."'";
        $this->db->query($query);
    }

    public function userdelete($id){
        $this->db = $this->getDI()->getShared("db");
        $query = "Delete from core_member where member_id ='".$id."'";
        $this->db->query($query);
    }
}