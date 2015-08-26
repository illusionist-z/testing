<?php

namespace workManagiment\Core\Models\Db;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CoreMember extends \Library\Core\BaseModel {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public static function getInstance() {
        return new self();
    }

    public function getusername() {        
        $this->db = $this->getDI()->getShared("db");        
        $user_name = $this->db->query("SELECT * FROM core_member");                                          
        $getname = $user_name->fetchall();
        return $getname;
    }
    
    public function getoneusername($username){
         $this->db = $this->getDI()->getShared("db");
         $user_name = $this->db->query("SELECT * FROM core_member where member_login_name ='".$username."'");        
         $getname = $user_name->fetchall();
         return $getname;
    }

    /**
     * @author david
     * @return username by last month
     */
    public function getlastname() {
        $this->db = $this->getDI()->getShared("db");
        $user_name = $this->db->query("SELECT * FROM core_member WHERE  created_dt >= (NOW() - INTERVAL 8 MONTH) limit 4");
        $laname = $user_name->fetchall();
        return $laname;
    }

    /**
     * 
     * @param type $tz
     * @param type $id
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function updatetimezone($tz, $id) {

        $this->db = $this->getDI()->getShared("db");

        $this->db->query("UPDATE core_member SET timezone ='" . $tz . "'  WHERE member_id ='" . $id . "' ");
    }
    
    /**
     * 
     * @param type $member_id
     * @param type $member
     * @param type $filename
     * @return string
     */
    public function addnewuser($member_id, $member, $filename) {

        $arr = (explode(",", $member['user_role']));
        $pass = sha1($member['password']);
        $today = date("Y-m-d H:i:s");
        if($member['username']==NULL OR $member['password']==NULL OR $member['dept']==NULL OR $member['position']==NULL OR $member['email']==NULL OR $member['phno']==NULL OR $member['address']==NULL ){
      
          $msg="Insert All Data";
        }
        else{
        //uploading file
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $this->db->query("INSERT INTO core_member (member_id,member_login_name,member_password,member_dept_name,position,member_mail,member_mobile_tel,member_address,member_profile,creator_id,created_dt,updated_dt)"
                . " VALUES(uuid(),'" . $member['username'] . "','" . $pass . "','" . $member['dept'] . "','" . $member['position'] . "','" . $member['email'] . "','" . $member['phno'] . "','" . $member['address'] . "','" . $filename . "','" . $member_id . "','" . $today . "','0000-00-00 00:00:00')");
        $user_name = $this->db->query("SELECT * FROM core_member WHERE  member_login_name='" . $member['username'] . "'");
        $us = $user_name->fetchall();
      
        foreach ($us as $value) {
            $this->db->query("INSERT INTO core_permission_rel_member (rel_member_id,permission_member_group_member_name,rel_permission_group_code,creator_id,created_dt)"
                    . " VALUES('" . $value['member_id'] . "','" . $arr['1'] . "','" . $arr['0'] . "','" . $member_id . "',now())");
        }
        $msg="New User is added succesfully";
        }
        return $msg;
    }
    
    public function UserDetail($id) {

        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_id='" . $id . "'");

        $user = $user->fetchall();
        return $user;
    }

    /**
     * 
     * @return type
     * getting pending leavedays detail
     * for admin notification
     * @author Su Zin Kyaw
     */
    public function GetAdminNoti() {
        $AdminNoti = $this->db->query("SELECT * FROM leaves JOIN core_member ON core_member.member_id=leaves.member_id WHERE leaves.leave_status=0");
        $noti = $AdminNoti->fetchall();
        return $noti;
    }

    /**
     * 
     * @param type $id
     * @return type
     * getting accepted and rejected leavedays detail
     * for user notification
     * @author Su Zin Kyaw
     */
    public function GetUserNoti($id) {
        $UserNoti = $this->db->query("SELECT * FROM leaves JOIN core_member ON core_member.member_id=leaves.member_id WHERE leaves.leave_status!=0 AND leaves.member_id='" . $id . "'");
        $noti = $UserNoti->fetchall();
        return $noti;
    }

    /**
     * 
     * @param type $id
     * @return type
     * getting notification detail
     * @author Su Zin Kyaw
     */
    public function getdetail($data) {
        $Detail = $this->db->query("SELECT * FROM leaves JOIN core_member ON core_member.member_id=leaves.member_id WHERE leaves.start_date='" . $data['1'] . "' AND leaves.member_id='" . $data['0'] . "'");
        $detail = $Detail->fetchall();

        return $detail;
    }

    /**
     * 
     * @param type $d
     * updating core member'profile
     * while user change something in profile
     * @author Su Zin Kyaw
     */
    public function updatedata($d, $id) {
        $this->db = $this->getDI()->getShared("db");
        //print_r($d);exit;
        if ($d['password'] == $d['temp_password']) {
            
            $this->db->query("UPDATE core_member set core_member.member_login_name='" . $d['username'] . "' , "
                    . "core_member.member_dept_name='" . $d['dept'] . "' , core_member.position='" . $d['position'] . "'"
                    . ", core_member.member_mail='" . $d['email'] . "' , core_member.member_address='" . $d['add'] . "'"
                    . ", core_member.member_mobile_tel='" . $d['phno'] . "' ,core_member.member_profile='" . $d['file'] . "' WHERE core_member.member_id='" . $id . "' ");
        } else {
         
            $this->db->query("UPDATE core_member set core_member.member_login_name='" . $d['username'] . "' ,  "
                    . "core_member.member_dept_name='" . $d['dept'] . "' , core_member.position='" . $d['position'] . "' "
                    . "AND core_member.member_mail='" . $d['email'] . "' , core_member.member_mobile_tel='" . $d['phno'] . "' "
                    . "AND core_member.member_address='" . $d['add'] . "' , core_member.member_password='" . sha1($d['password']) . "' WHERE core_member.member_id='" . $id . "'");
        }

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }

}
