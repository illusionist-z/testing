<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Users extends Model
{
    
    public function validation()
    {
        $this->validate(new EmailValidator(array(
            'field' => 'email'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'email',
            'message' => 'Sorry, The email was registered by another user'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'username',
            'message' => 'Sorry, That username is already taken'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
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
}
