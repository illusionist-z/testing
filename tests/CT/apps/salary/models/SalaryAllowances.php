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
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Filter;
use salts\Salary\Models;

class SalaryAllowances extends Models\Allowances {
    //put your code here
     public $allowance_id;
    public $allowance_name;
    public $allowance_amount;

    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * 
     * @param type $all_value
     * @param type $all_name
     * @param type $count
     * Adding Allowances to allowance table
     */
    public function addAllowance($all_value, $all_name, $count) {
        try {           
            $data = Array();
           
            $data['created_dt'] = date("Y-m-d H:i:s");          
                    
            $this->db = $this->getDI()->getShared("db");
            
            for ($x = 1; $x < $count; $x++) {
                
                $all = new Models\Allowances();
                $data['allowance_id'] = uniqid();       
               
                $data['allowance_name'] = $all_name;               
                               
                $data['allowance_amount'] = $all_value;
                
                $all->save($data);
            }
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    /**
     * get allowance list with paging
     * @author Su Zin Kyaw
     * @return type
     */
    public function showAlwlist() {
        try {
            $row = $this->modelsManager->createBuilder()
                    ->columns('allowance_id,allowance_name,allowance_amount')
                    ->from('salts\Salary\Models\Allowances')
                    ->orderBy('salts\Salary\Models\Allowances.created_dt DESC')
                    ->getQuery()
                    ->execute();
            return $row;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param type $data
     * update edited data to allowances table
     * @author Su Zin Kyaw
     */
    public function editAllowance($data) {
        try {
            $filter = new Filter();
            $name = $filter->sanitize($data['name'], "string");
            $allowance_amount = $filter->sanitize($data['allowance_amount'], "string");
            
            $id = $data['id'];
            $all = Allowances::findFirst('allowance_id ="' . $id . '"');
            $all->allowance_amount = $allowance_amount;
            $all->allowance_name = $name;
            $all->update();
            // $sql = "Update allowances SET allowance_name ='" . $name . "',allowance_amount ='" . $allowance_amount . "' Where allowances.allowance_id='" . $data['id'] . "'";
            //$this->db->query($sql);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    /**
     * 
     * @param type $id
     * delete allowance data
     * @author Su Zin Kyaw
     */
    public function deleteAllowance($id) {
        $filter = new Filter();
        $allowanceid = $filter->sanitize(isset($id) ? $id : "", "string");
        try {
             $this->db = $this->getDI()->getShared("db");
            $sql = "Delete From allowances  Where allowances.allowance_id='" . $allowanceid . "'";
            $this->db->query($sql);
            
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function getAllallowances() {
        $this->db = $this->getDI()->getShared("db");
        try {
            $sql = "select * from allowances";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }

    /**
     * 
     * @param type $allowance
     * @param type $member_id
     * @return type
     * @author zin mon
     */
    public function saveAllowance($allowance, $member_id) {
        try {
            for ($i = 0; $i < count($allowance); $i++) {
                $Allowance = new SalaryMasterAllowance();
                $Allowance->allowance_id = $allowance[$i];
                $Allowance->member_id = $member_id ;
                $Allowance->save();
           }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function editAll($allid) {
        try {
            $this->db = $this->getDI()->getShared("db");
            $sql = "select * from allowances where allowances.allowance_id ='" . $allid . "'";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

}
