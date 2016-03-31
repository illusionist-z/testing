<?php

namespace salts\Setting\Models;
use Phalcon\Filter;
use Phalcon\Mvc\Model;

class CoreMember extends Model {

    public $user_rule;
    public $member_login_name;
    public $user_rule_member_id;
    public $member_id;
    public $member_dept_name;
    public $position;
    public $member_mail;
    public $member_mobile_tel;
    public $member_profile;
    public $member_password;
    /**
     * 
     * @param type $data
     * updating core member'profile
     * while user change something in profile
     * @author Su Zin Kyaw
     */
    public function updatedata($data, $id) {
        $this->db = $this->getDI()->getShared("db");
     
        
         if ($data['password'] !=$data['temp_password']) {
              $changeprofile = "UPDATE core_member set core_member.member_login_name='" . $data['username'] . "' ,  "
                    . "core_member.member_dept_name='" . $data['dept'] . "' , core_member.position='" . $data['position'] . "' "
                    . " ,core_member.member_mail='" . $data['email'] . "' , core_member.member_mobile_tel='" . $data['phno'] . "' "
                    . " ,core_member.member_address='" . $data['add'] . "' , core_member.member_password='" . sha1($data['password']) . "'  WHERE core_member.member_id='" . $id . "'";
            
              $this->db->query($changeprofile);
         }else{
                      $this->db->query("UPDATE core_member set core_member.member_login_name='" . $data['username'] . "' , "
                    . "core_member.member_dept_name='" . $data['dept'] . "' , core_member.position='" . $data['position'] . "'"
                    . ", core_member.member_mail='" . $data['email'] . "' , core_member.member_address='" . $data['add'] . "'"
                    . ", core_member.member_mobile_tel='" . $data['phno'] . "'  WHERE core_member.member_id='" . $id . "' ");  
            }
        


    }
    
    
     public function userData($id) {
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_id='" . $id . "'");
        $user = $user->fetchArray();
        return $user;
    }

}
