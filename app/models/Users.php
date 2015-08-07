<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
class Users extends Model
{
    
    public function login($email,$password)
    {
        //echo core_member;exit;
         // print_r(\Phalcon\Di::getDefault()->getShared('db'));exit;
        $this->db=$this->getDI()->getShared("db");
        //$user_name=$this->db->query("SELECT * FROM users where loginname='".$email."' and password='".$password."'");
        $user_name=$this->db->query("SELECT * FROM core_member where member_login_name='".$email."' and member_password='".sha1($password)."'");
        //echo $user_name->numRows();exit;
        $result=$user_name->fetchArray();
        return $result;
    }
    
    public function getpermissiongp(){
        $this->db=$this->getDI()->getShared("db");
         $getpermissiongp=$this->db->query("SELECT * FROM core_permission_group");
        //echo $user_name->numRows();exit;
        $result=$getpermissiongp->fetchall();
        return $result;
    }
    
    public function getallpermission(){
        $this->db=$this->getDI()->getShared("db");
         $getpermissiongp=$this->db->query("SELECT * FROM core_permission");
        //echo $user_name->numRows();exit;
        $result=$getpermissiongp->fetchall();
        return $result;
    }
    
    // get today attendance list for admin
    public function gettodaylist(){
         $this->db=$this->getDI()->getShared("db");
         $today=date("Y:m:d");
         $result=$this->db->query("SELECT * FROM attendances JOIN core_member ON attendances.member_id=core_member.member_id WHERE attendances.att_date='".$today."'");
         //print_r($result);exit;
         $row=$result->fetchall();  
         //print_r($row);exit;
        return $row;
    }
    
    // get all staff name
    public function getusername(){
         $this->db=$this->getDI()->getShared("db");
         $user_name=$this->db->query("SELECT * FROM core_member");
         //print_r($user_name);exit;
         $getname=$user_name->fetchall(); 
        return $getname;
    }
}
