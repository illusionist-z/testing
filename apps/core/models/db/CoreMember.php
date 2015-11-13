<?php

namespace workManagiment\Core\Models\Db;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use workManagiment\Core\Models\Db\CoreMember;
use workManagiment\Core\Models\Db\CorePermissionRelMember;
use workManagiment\Core\Models\Db\CorePermissionGroupId;
use Phalcon\Mvc\Controller;
use Phalcon\Filter;

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
        /* $this->db = $this->getDI()->getShared("db");        
          $user_name = $this->db->query("SELECT * FROM core_member");
          $getname = $user_name->fetchall();
          return $getname; */
        $query = "SELECT * FROM workManagiment\Core\Models\Db\CoreMember WHERE deleted_flag=0 order by created_dt desc";
        $row = $this->modelsManager->executeQuery($query);
        //print_r($row);exit;
        return $row;
    }
    
    public function getgroupid() {
    $query = "Select member_id,member_login_name,group_id from core_member "
                . "left join core_permission_rel_member on core_member.member_id=core_permission_rel_member.rel_member_id "
                . "left join core_permission_group_id on core_permission_group_id.name_of_group = core_permission_rel_member.rel_permission_group_code";        
    
    $data = $this->db->query($query);
    
    $groupid = $data->fetchall();
    
     return $groupid;
    }      
    
    public function username($name) {     
        $name = '%' . $name . '%';
        $query = "SELECT * FROM workManagiment\Core\Models\Db\CoreMember WHERE full_name = '$name' AND deleted_flag=0 order by created_dt desc";
        $row = $this->modelsManager->executeQuery($query);        
        foreach ($row as $rs) {            
            echo '<li>' . $rs->full_name . '</li>';
        }
        return $row;
    }

    /*
     * user list search with name in user list
     */

    public function getoneusername($username) {
        /* $this->db = $this->getDI()->getShared("db");
          $user_name = $this->db->query("SELECT * FROM core_member where member_login_name ='".$username."'");
          $getname = $user_name->fetchall();
          return $getname; */
        $filter = new Filter();
        $username = $filter->sanitize($username, "string");
        $getname = $this->modelsManager->createBuilder()
                ->columns(array('core.*'))
                ->from(array('core' => 'workManagiment\Core\Models\Db\CoreMember'))
                ->where('core.full_name = :username:', array('username' => $username))
                ->andWhere('core.deleted_flag = 0')
                ->getQuery()
                ->execute();
        //print_r($row);exit;
        /*  foreach($row as $rows) {
          echo $rows->member_login_name;
          // echo $rows->attendances->att_date;
          }
          exit; */

        return $getname;
    }

    public function searchuser($search) {
        $filter = new Filter();
        $search = $filter->sanitize($search, "string");
        $searchname = $this->db->query("select member_login_name from core_member where member_login_name like '%$search%' ");
        $return = $searchname->fetchall();
        return $return;
    }

    /**
     * @author david
     * @return username by last month
     */
    public function getlastname() {
        $username = "SELECT * FROM workManagiment\Core\Models\Db\CoreMember where deleted_flag=0 order by  created_dt desc limit 4";
        $laname = $this->modelsManager->executeQuery($username);
        return $laname;
    }
    
     
    

    /**
     * 
     * @param type $loginParams
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * updating core member updated_dt after one year
     */
    public function updatecontract($loginParams) {
        $filter = new Filter();
        $name = $filter->sanitize($loginParams['member_login_name'], "string");
        $password = $filter->sanitize($loginParams['password'], "string");
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * from core_member where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        $user1 = $user->fetchall();
        $today = date("Y-m-d H:i:s");
        if ($user1['0']['working_year_by_year'] == NULL) {
            $end_date = date('Y-m-d', strtotime("+1 year", strtotime($user1['0']['working_start_dt'])));
        } else {
            $end_date = date('Y-m-d', strtotime("+1 year", strtotime($user1['0']['working_year_by_year'])));
        }
        if ($end_date <= $today) {
            $this->db->query("UPDATE core_member set core_member.working_year_by_year='" . $end_date . "'  where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        }
    }
   public function getlang($member){        
     $query = "Select lang from core_member where member_login_name ='".$member['member_login_name']."'";
        $result = $this->db->query($query);
        $lang=$result->fetch();
        return $lang;        
    }
    /**
     * 
     * @param type $member_id
     * @param type $member
     * @param type $filename
     * @return string
     */
    public function addnewuser($member_id, $member) {
       // print_r($member);exit;
        
        $arr = (explode(",", $member['user_role']));
        $pass = sha1($member['password']);
        $today = date("Y-m-d H:i:s");

        $filter = new Filter();
        $username = $filter->sanitize($member['username'], "string");
        $full_name = $filter->sanitize($member['full_name'], "string");

        $pass = $filter->sanitize($pass, "string");
        $dept = $filter->sanitize($member['dept'], "string");
        $position = $filter->sanitize($member['position'], "string");
        $email = $filter->sanitize($member['email'], "email");
        $phno = $filter->sanitize($member['phno'], "int");
        $address = $filter->sanitize($member['address'], "string");

        //uploading file
        $target_dir = "uploads/";
        $profile = $_FILES["fileToUpload"]["name"];
        //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $Real_pic_name=explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = rand(1, 99999) . '.' . end($Real_pic_name);
        $targetfile = $target_dir . $newfilename;

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetfile);
        $this->db->query("INSERT INTO core_member (member_id,full_name,member_login_name,member_password,member_dept_name,position,member_mail,member_mobile_tel,member_address,member_profile,creator_id,created_dt,updated_dt,working_start_dt)"
                . " VALUES(uuid(),'" . $full_name . "','" . $username . "','" . $pass . "','" . $dept . "','" . $position . "','" . $email . "','" . $phno . "','" . $address. "','" . $newfilename . "','" . $member_id . "','" . $today . "','0000-00-00 00:00:00','" . $member['work_sdate'] . "')");
        $user_name = $this->db->query("SELECT * FROM core_member WHERE  member_login_name='" . $member['username'] . "'");
        $us = $user_name->fetchall();

        foreach ($us as $value) {
            $this->db->query("INSERT INTO core_permission_rel_member (rel_member_id,permission_member_group_member_name,rel_permission_group_code,creator_id,created_dt)"
                    . " VALUES('" . $value['member_id'] . "','" . $arr['1'] . "','" . $arr['0'] . "','" . $member_id . "',now())");
        }
    }

    public function UserDetail($id) {

        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_id='" . $id . "'");
        $user = $user->fetchall();
        return $user;
    }

    public function Userdata($id) {
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_id='" . $id . "'");
        $user = $user->fetchArray();
        return $user;
    }

    /**
     * 
     * @return type
     * getting pending leavedays detail
     * for admin notification
     * @author Su Zin Kyaw
     */
    public function GetAdminNoti($id) {
        $final_result = array();
        $this->db = $this->getDI()->getShared("db");
        $sql = "SELECT * FROM core_notification JOIN core_member ON core_member.member_id=core_notification.noti_creator_id WHERE core_notification.noti_status=0 AND core_notification.noti_creator_id='" . $id . "' ";
        $AdminNoti = $this->db->query($sql);
        $noti = $AdminNoti->fetchall();
        //$notirel=$this->db->query("SELECT * FROM notification_rel_member JOIN core_member ON core_member.member_id=notification_rel_member.member_id WHERE notification_rel_member.status=2 AND notification_rel_member.member_id!= '" . $id . "'");
        //$noti[]=$notirel->fetchall();
        //var_dump($noti);exit;
        $i=0;
        foreach ($noti as $noti) {
            
            $sql = "SELECT  * FROM " . $noti['module_name'] . " JOIN core_member ON core_member.member_id=" . $noti['module_name'] . ".member_id WHERE " . $noti['module_name'] . ".noti_id='" . $noti['noti_id'] . "' ";
            //print_r($sql);exit;
            $result = $this->db->query($sql);
            $final_result[] = $result->fetchall();
            //$final_result[$i]['0']['creator_name']=$noti['creator_name'];
            $i++;
           
            
        }
        
      // var_dump($final_result);exit;
        return $final_result;
    }

    /**
     * 
     * @param type $id
     * @return type
     * getting accepted and rejected leavedays detail
     * for user notification
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function GetUserNoti($id) {
        $final_result = array();
        $this->db = $this->getDI()->getShared("db");
        $sql = "SELECT * FROM core_notification_rel_member JOIN core_member ON core_member.member_id=core_notification_rel_member.member_id WHERE core_notification_rel_member.status=1 AND core_notification_rel_member.member_id= '" . $id . "'";
        //print_r($sql);exit;
        $UserNoti = $this->db->query($sql);

        $noti = $UserNoti->fetchall();
        $i=0;
        foreach ($noti as $noti) {

            $result = $this->db->query("SELECT  * FROM " . $noti['module_name'] . " JOIN core_member ON core_member.member_id=" . $noti['module_name'] . ".member_id WHERE " . $noti['module_name'] . ".noti_id='" . $noti['noti_id'] . "' ");
            $final_result[] = $result->fetchall();
            $final_result[$i]['0']['creator_name']=$noti['creator_name'];
            $i++;
        }
        
       //var_dump($final_result);exit;
        return $final_result;
    }

    /**
     * 
     * @param type $data
     * updating core member'profile
     * while user change something in profile
     * @author Su Zin Kyaw
     */
    public function updatedata($data, $id) {
        $this->db = $this->getDI()->getShared("db");

        if ($_FILES["fileToUpload"]["name"] == NULL) {
            $filename = $data['file'];
        } else {
            $pic = $data['file'];
            unlink("uploads/$pic");
            $filename = rand(1, 99999) . '.' . end(explode(".", $_FILES["fileToUpload"]["name"]));
            $target_dir = "uploads/";
            $target_file = $target_dir . $filename;
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }

        if ($data['password'] == $data['temp_password']) {

            $this->db->query("UPDATE core_member set core_member.member_login_name='" . $data['username'] . "' , "
                    . "core_member.member_dept_name='" . $data['dept'] . "' , core_member.position='" . $data['position'] . "'"
                    . ", core_member.member_mail='" . $data['email'] . "' , core_member.member_address='" . $data['add'] . "'"
                    . ", core_member.member_mobile_tel='" . $data['phno'] . "' ,core_member.member_profile='" . $filename . "' WHERE core_member.member_id='" . $id . "' ");
        } else {
            $changeprofile = "UPDATE core_member set core_member.member_login_name='" . $data['username'] . "' ,  "
                    . "core_member.member_dept_name='" . $data['dept'] . "' , core_member.position='" . $data['position'] . "' "
                    . " ,core_member.member_mail='" . $data['email'] . "' , core_member.member_mobile_tel='" . $data['phno'] . "' "
                    . " ,core_member.member_address='" . $data['add'] . "' , core_member.member_password='" . sha1($data['password']) . "' ,core_member.member_profile='" . $filename . "' WHERE core_member.member_id='" . $id . "'";
            $this->db->query($changeprofile);
            //echo $changeprofile;exit;
        }
        return $filename;
    }

    /**
     * 
     * @param type $id
     * @param type $sdate
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * update noti seen when user click ok
     */
    public function updateleave($id, $sdate) {
        $this->db = $this->getDI()->getShared("db");
        $sql = "UPDATE leaves set leaves.noti_seen=1 WHERE leaves.start_date='" . $sdate . "' AND leaves.member_id='" . $id . "'";
        $a = $this->db->query($sql);
    }

    //for auto complete function
    public function autousername() {
        $this->db = $this->getDI()->getShared("db");
        $user_name = $this->db->query("Select * from core_member where deleted_flag=0");
        $getname = $user_name->fetchall();
        return $getname;
    }

  

    public function GetAdminstratorId() {
        $this->db = $this->getDI()->getShared("db");
        $result = $this->db->query("SELECT rel_member_id FROM core_permission_rel_member JOIN core_member ON core_member.member_id=core_permission_rel_member.rel_member_id WHERE core_permission_rel_member.rel_permission_group_code='ADMIN' ");
        $result = $result->fetchall();

        return $result;
    }

}
