<?php

namespace workManagiment\Salary\Models;

use Phalcon\Mvc\Model;

class Allowances extends Model {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public function getall_allowances() {
        try {
            $sql = "select * from allowances";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }
    
    
    public function saveallowance($allowance,$member_id) {
        try {
            
            for($i=0;$i<count($allowance);$i++)
            {
            $sql = "INSERT INTO salary_master_allowance (allowance_id,member_id) VALUES('" . $allowance[$i] . "','" . $member_id . "')";
            $result = $this->db->query($sql);   
            }
        } catch (Exception $e) {
            echo $e;
        }

        return $result;
    }

}
