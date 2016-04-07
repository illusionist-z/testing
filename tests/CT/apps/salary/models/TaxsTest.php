<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalaryAllowances
 *
 * @author admin
 */
use Phalcon\Mvc\Model;
use salts\Salary\Models;

class TaxsTest extends Models\SalaryTaxs {

    //put your code here
   public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }

    public function getTaxlist() {
        try {
             $this->db = $this->getDI()->getShared("db");
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
            
            $this->db = $this->getDI()->getShared("db");
            $to = $data['taxs_from'] - 1;
            $data['taxs_diff'] = $data['taxs_to'] - $to;
            $sql = "Update salary_taxs SET taxs_from ='" . $data['taxs_from'] . "',taxs_to ='" . $data['taxs_to'] . "',taxs_rate ='" . $data['taxs_rate'] . "',taxs_diff ='" . $data['taxs_diff'] . "',ssc_emp ='" . $data['ssc_emp'] . "',ssc_comp ='" . $data['ssc_comp'] . "'  Where id='" . $data['id'] . "'";
            $this->db->query($sql);
        } catch (Exception $exc) {
            echo $exc;
        }
    }
}
