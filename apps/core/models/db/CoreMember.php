<?php

namespace workManagiment\Core\Models\Db;
        use Phalcon\Mvc\Model;
        use Phalcon\Mvc\Model\Query;
        use workManagiment\Core\Models\Db\CoreMember;
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
        /*$this->db = $this->getDI()->getShared("db");        
        $user_name = $this->db->query("SELECT * FROM core_member");                                          
        $getname = $user_name->fetchall();
        return $getname;*/
        $query = "SELECT * FROM workManagiment\Core\Models\Db\CoreMember order by created_dt desc";
        $row = $this->modelsManager->executeQuery($query);
        //print_r($row);exit;
        return $row;
    }
    /*
     * user list search with name in user list
     */
    public function getoneusername($username){
         /*$this->db = $this->getDI()->getShared("db");
         $user_name = $this->db->query("SELECT * FROM core_member where member_login_name ='".$username."'");        
         $getname = $user_name->fetchall();
         return $getname;*/
        
        $getname =   $this->modelsManager->createBuilder()
                            ->columns(array('core.*'))
                            ->from(array('core' => 'workManagiment\Core\Models\Db\CoreMember'))                             
                            ->where('core.member_login_name = :username:', array('username' => $username))                            
                            ->getQuery()
                            ->execute();                                                   
                // print_r($row);exit;
                  /*  foreach($row as $rows) {
                          echo $rows->member_login_name;
                         // echo $rows->attendances->att_date;
                    }
                    exit;*/
        return $getname;
    }

    /**
     * @author david
     * @return username by last month
     */
    public function getlastname() {
        /*$this->db = $this->getDI()->getShared("db");
        $user_name = $this->db->query("SELECT * FROM core_member WHERE  created_dt >= (NOW() - INTERVAL 8 MONTH) limit 4");
        $laname = $user_name->fetchall();
        return $laname;*/
        $username = "SELECT * FROM workManagiment\Core\Models\Db\CoreMember order by  created_dt desc limit 4";
        $laname=$this->modelsManager->executeQuery($username);
       // print_r($laname);exit;
        return $laname;
    }

   
   public function updatecontract($loginParams){
       $name = $loginParams['member_login_name'];
        $password = $loginParams['password'];
        $this->db = $this->getDI()->getShared("db");
         $user=$this->db->query("SELECT * from core_member where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        $user1=$user->fetchall();
       $today =date("Y-m-d H:i:s");
       if($user1['0']['updated_dt']=='0000-00-00 00:00:00'){
          $end_date=date('Y-m-d', strtotime("+1 year", strtotime($user1['0']['created_dt']))); 
       }
       else{
            $end_date=date('Y-m-d', strtotime("+1 year", strtotime($user1['0']['updated_dt']))); 
       }
       if($end_date<=$today){
         $this->db->query("UPDATE core_member set core_member.updated_dt='" . $end_date . "'  where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
       }
    }
   
    /**
     * 
     * @param type $member_id
     * @param type $member
     * @param type $filename
     * @return string
     */
    public function addnewuser($member_id, $member) {

        $arr = (explode(",", $member['user_role']));
        $pass = sha1($member['password']);
        $today = date("Y-m-d H:i:s");
        
        //uploading file
        $target_dir = "uploads/";
        //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $newfilename = rand(1,99999) . '.' . end(explode(".",$_FILES["fileToUpload"]["name"]));
        $targetfile = $target_dir . $newfilename;

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetfile);
        $this->db->query("INSERT INTO core_member (member_id,member_login_name,member_password,member_dept_name,position,member_mail,member_mobile_tel,member_address,member_profile,creator_id,created_dt,updated_dt)"
                . " VALUES(uuid(),'" . $member['username'] . "','" . $pass . "','" . $member['dept'] . "','" . $member['position'] . "','" . $member['email'] . "','" . $member['phno'] . "','" . $member['address'] . "','" . $newfilename . "','" . $member_id . "','" . $today . "','0000-00-00 00:00:00')");
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

    /**
     * 
     * @return type
     * getting pending leavedays detail
     * for admin notification
     * @author Su Zin Kyaw
     */
    public function GetAdminNoti() { 
        $this->db = $this->getDI()->getShared("db");
        $AdminNoti = $this->db->query("SELECT * FROM leaves JOIN core_member ON core_member.member_id=leaves.member_id WHERE leaves.leave_status=0 order by leaves.date desc");
        $noti = $AdminNoti->fetchall();
        return $noti;
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
        $this->db = $this->getDI()->getShared("db");
        $UserNoti = $this->db->query("SELECT * FROM leaves JOIN core_member ON core_member.member_id=leaves.member_id WHERE leaves.leave_status!=0 AND leaves.noti_seen=0 AND  leaves.member_id='" . $id . "'");
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
        $filename=rand(1,99999) . '.' . end(explode(".",$_FILES["fileToUpload"]["name"]));
        if ($d['password'] == $d['temp_password']) {
            
            $this->db->query("UPDATE core_member set core_member.member_login_name='" . $d['username'] . "' , "
                    . "core_member.member_dept_name='" . $d['dept'] . "' , core_member.position='" . $d['position'] . "'"
                    . ", core_member.member_mail='" . $d['email'] . "' , core_member.member_address='" . $d['add'] . "'"
                    . ", core_member.member_mobile_tel='" . $d['phno'] . "' ,core_member.member_profile='" . $filename . "' WHERE core_member.member_id='" . $id . "' ");
        } else {
         
            $this->db->query("UPDATE core_member set core_member.member_login_name='" . $d['username'] . "' ,  "
                    . "core_member.member_dept_name='" . $d['dept'] . "' , core_member.position='" . $d['position'] . "' "
                    . "AND core_member.member_mail='" . $d['email'] . "' , core_member.member_mobile_tel='" . $d['phno'] . "' "
                    . "AND core_member.member_address='" . $d['add'] . "' , core_member.member_password='" . sha1($d['password']) . "' WHERE core_member.member_id='" . $id . "'");
        }

        $target_dir = "uploads/";
        $target_file = $target_dir . $filename;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }
    
    /**
     * 
     * @param type $id
     * @param type $sdate
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * update noti seen when user click ok
     */
    public function updateleave($id,$sdate){
          $this->db = $this->getDI()->getShared("db");
          $sql = "UPDATE leaves set leaves.noti_seen=1 WHERE leaves.start_date='" . $sdate . "' AND leaves.member_id='" .$id. "'";
          $a=$this->db->query($sql);                                                  
    }

}
