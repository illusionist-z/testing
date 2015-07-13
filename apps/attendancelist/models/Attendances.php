<?php

namespace workManagiment\Attendancelist\Models;

use Phalcon\Mvc\Model;

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
            
            $sql = "SELECT * FROM attendances JOIN core_member ON attendances.member_id=core_member.member_id WHERE attendances.att_date='" . $today . "' and member_login_name='" . $name . "'";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } else {
            //show att today list
            $result = $this->db->query("SELECT * FROM attendances JOIN core_member ON attendances.member_id=core_member.member_id WHERE attendances.att_date='" . $today . "'");
            $row = $result->fetchall();
            //print_r($row);exit;
        }
        //print_r($row);exit;
        return $row;
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
   
    public function setcheckintime($id){
     echo "setcheckintime";echo $id;

        
    }
}
