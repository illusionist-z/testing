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
        $filter = new Filter();
        $this->db = $this->getDI()->getShared("db");
         $company_id=($this->getDI()->getSession()->get(db_config)['company_id']);
         $target_dir = "uploads/$company_id./";
        
        if (!is_dir($target_dir)) {
         mkdir($target_dir);
       }
        if ($_FILES["fileToUpload"]["name"] == NULL) {
            $filename = $data['file'];
        } else {
            $pic = $data['file'];
            unlink("uploads/$pic");
            $filename =($this->getDI()->getSession()->get(db_config)['company_id'])."__".($this->getDI()->getSession()->get(user)['member_id']). '.' . end(explode(".", $_FILES["fileToUpload"]["name"]));
            $target_file = $target_dir . $filename;
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }

           
            $CoreMember = new CoreMember();
            $array = $CoreMember::findFirst('member_id ="' . $id.'"');
            $array->member_login_name = $filter->sanitize($data['username'], "string");
            $array->member_dept_name = $filter->sanitize($data['dept'], "string"); 
            $array->position = $filter->sanitize($data['position'], "string");     
            $array->member_mail = $filter->sanitize($data['email'], "string");     
            $array->member_address = $filter->sanitize($data['add'], "string");     
            $array->member_mobile_tel = $filter->sanitize($data['phno'], "string");     
            $array->member_profile = $filter->sanitize($data['dept'], "string");     
            $array->member_dept_name = $filter->sanitize($filename, "string");     
             if ($data['password'] !=$data['temp_password']) {
                  $array->member_password = $filter->sanitize(sha1($data['password']), "string");     

             }
            $array->update();

        return $filename;
    }
    
    
     public function userData($id) {
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_id='" . $id . "'");
        $user = $user->fetchArray();
        return $user;
    }

}
