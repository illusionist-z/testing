<?php namespace workManagiment\Core\Models\Db;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class CoreMember extends \Library\Core\BaseModel{
    
    public function initialize() {
        parent::initialize();
    }
    
    public static function getInstance()
    {
        return new self();
    }
    
    
      public function getusername() {
        $this->db = $this->getDI()->getShared("db");
        $user_name = $this->db->query("SELECT * FROM core_member");
        //print_r($user_name);exit;
        $getname = $user_name->fetchall();
        return $getname;
    }
    

    public function updatetimezone($tz,$id){
     
          $this->db = $this->getDI()->getShared("db");
        
        $this->db->query("UPDATE core_member SET timezone ='".$tz."'  WHERE member_id ='".$id."' ");
        
    }
    
    public function addnewuser($username,$password, $dept, $position,$email, $phno,$address){
    $this->db = $this->getDI()->getShared("db");
    $pass=MD5($password);
    if($username==NULL OR $password==NULL OR $dept==NULL OR $position==NULL OR $email==NULL OR $phno==NULL OR $address==NULL ){
      
    echo '<script type="text/javascript">alert("Please,Insert All Data! ")</script>';
     echo "<script type='text/javascript'>window.location.href='../../manageuser/user/adduser';</script>";
        
    }
    else {
         $this->db->query("INSERT INTO core_member (member_login_name,member_password,member_dept_name,job_title,member_mail,member_mobile_tel,member_address)"
    . " VALUES('" . $username . "','" . $pass . "','" . $dept . "','" . $position . "','" . $email . "','" . $phno . "','" . $address . "')");
    echo '<script type="text/javascript">alert("New User is Added Successfully! ")</script>';
     echo "<script type='text/javascript'>window.location.href='../../manageuser/user/adduser';</script>";
        }
    }
}