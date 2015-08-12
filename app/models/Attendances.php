<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
class Attendances extends Model
{
    
    public function search_result($name)
    {
         $this->db=$this->getDI()->getShared("db");
         $today=date("Y:m:d");
         $result=$this->db->query("SELECT * FROM attendances JOIN core_member ON attendances.member_id=core_member.member_id WHERE attendances.att_date='".$today."' and member_login_name='".$name."'");
         //print_r($result);exit;
         $row=$result->fetchall();  
         //print_r($row);exit;
          return $row;
    }
    
}
