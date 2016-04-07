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

class TaxsDeduction extends Models\SalaryTaxsDeduction {

    //put your code here
    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }

    public function getDeducelist() {
        try {
            $this->db = $this->getDI()->getShared("db");
            $data = $this->db->query("SELECT * FROM salary_taxs_deduction ");
            $result = $data->fetchall();
        } catch (Exception $exc) {
            echo $exc;
        }
        return $result;
    }

    public function getdectdata($id) {
        try {
            $data = $this->db->query("SELECT * FROM salary_taxs_deduction WHERE deduce_id='" . $id . "' ");
            $result = $data->fetchall();
        } catch (Exception $exc) {
            echo $exc;
        }
        return $result;
    }

    public function editDeduction($data) {
        try {
           
            $this->db = $this->getDI()->getShared("db");
            $sql = "Update salary_taxs_deduction SET deduce_name ='" . $data['deduce_name'] . "',amount ='" . $data['amount'] . "'  Where salary_taxs_deduction.deduce_id='" . $data['deduce_id'] . "'";
            $this->db->query($sql);
        } catch (Exception $exc) {
            echo $exc;
        }
    }

    public function addDeduction($data) {
        try {
            $this->db->query("INSERT INTO salary_taxs_deduction (deduce_id,deduce_name,amount) VALUES (uuid(),'" . $data['deduce_name'] . "','" . $data['amount'] . "')");
        } catch (Exception $exc) {
            echo $exc;
        }
    }

    public function deleteDeduction($deduce_id) {
        try {
            $this->db->query("DELETE FROM  salary_taxs_deduction WHERE deduce_id='" . $deduce_id . "'");
        } catch (Exception $exc) {
            echo $exc;
        }
    }

}
