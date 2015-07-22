<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class SalaryMaster extends Model {

    /**
     * 
     * @return type
     */
   public function savesalary($member_id,$basic_salary,$travel_fee,$overtime){
         $this->db = $this->getDI()->getShared("db");
        $sql = "INSERT INTO salary_master (member_id,basic_salary,travel_fee,over_time) VALUES('" . $member_id . "','" . $basic_salary . "','" . $travel_fee . "','" . $overtime . "')";
        //echo $sql;exit;
        $result = $this->db->query($sql);
        
        //print_r($row);exit;
        return $result;       
    }
}
