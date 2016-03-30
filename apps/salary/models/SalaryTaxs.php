<?php

namespace salts\Salary\Models;

use Phalcon\Mvc\Model;

class SalaryTaxs extends Model {

    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }

    public function getTaxlist() {
        try {
            $data = $this->db->query("SELECT * FROM salary_taxs ");
            $result = $data->fetchall();
        } catch (Exception $exc) {
            echo $exc;
        }
        return $result;
    }

    public function getTaxdata($id) {
        try {
            $data = $this->db->query("SELECT * FROM salary_taxs WHERE id='" . $id . "'");
            $result = $data->fetchall();
        } catch (Exception $exc) {
            echo $exc;
        }
        return $result;
    }

    public function editTax($data) {
        try {
            $to = $data['taxs_from'] - 1;
            $data['taxs_diff'] = $data['taxs_to'] - $to;
            $sql = "Update salary_taxs SET taxs_from ='" . $data['taxs_from'] . "',taxs_to ='" . $data['taxs_to'] . "',taxs_rate ='" . $data['taxs_rate'] . "',taxs_diff ='" . $data['taxs_diff'] . "',ssc_emp ='" . $data['ssc_emp'] . "',ssc_comp ='" . $data['ssc_comp'] . "'  Where id='" . $data['id'] . "'";
            $this->db->query($sql);
        } catch (Exception $exc) {
            echo $exc;
        }
    }
    

}
