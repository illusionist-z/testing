<?php

namespace salts\Salary\Models;

use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Filter;

class Allowances extends Model {

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
            $filter = new Filter();
            $data['created_dt'] = date("Y-m-d H:i:s");
            
            $this->db = $this->getDI()->getShared("db");
            for ($x = 1; $x < $count; $x++) {
                $all = new Allowances();
                $data['allowance_id'] = uniqid();
                $data['allowance_name'] = $filter->sanitize(isset($all_name['"' . $x . '"']) ? $all_name['"' . $x . '"'] : "", "string");
                $data['allowance_amount'] = $filter->sanitize(isset($all_value['"' . $x . '"']) ? $all_value['"' . $x . '"'] : "", "int");
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
            $all = new Allowances();
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
        $id = $filter->sanitize(isset($id) ? $id : "", "string");
        try {
            $sql = "Delete From allowances  Where allowances.allowance_id='" . $id . "'";
            $this->db->query($sql);
            echo $sql;exit;
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function getAllallowances() {
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
                $sql = "INSERT INTO salary_master_allowance (allowance_id,member_id) VALUES('" . $allowance[$i] . "','" . $member_id . "')";
                $result = $this->db->query($sql);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function editAll($allid) {
        try {
            $sql = "select * from allowances where allowances.allowance_id ='" . $allid . "'";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

}
