<?php

namespace workManagiment\Salary\Models;

use Phalcon\Mvc\Model;

class SalaryMaster extends Model {

    /**
     * save salary to salary master
     * @return type
     */
    public function savesalary($data) {
        try {
            $this->db = $this->getDI()->getShared("db");
            $sql = "INSERT INTO salary_master (id,member_id,basic_salary,travel_fee,over_time) VALUES(uuid(),'" . $data['member_id'] . "','" . $data['basic_salary'] . "','" . $data['travelfee'] . "','" . $data['overtime'] . "')";
            //echo $sql;exit;
            $result = $this->db->query($sql);
        } catch (Exception $e) {
            echo $e;
        }

        return $result;
    }

}
