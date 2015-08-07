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

}
