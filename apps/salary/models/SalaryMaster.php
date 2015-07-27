<?php

namespace workManagiment\Salary\Models;

use Phalcon\Mvc\Model;

class SalaryMaster extends Model {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * save salary to salary master
     * @return type
     */
    public function savesalary($data) {
        try {

            $sql = "INSERT INTO salary_master (id,member_id,basic_salary,travel_fee,over_time) VALUES(uuid(),'" . $data['member_id'] . "','" . $data['basic_salary'] . "','" . $data['travelfee'] . "','" . $data['overtime'] . "')";
            //echo $sql;exit;
            $result = $this->db->query($sql);
        } catch (Exception $e) {
            echo $e;
        }

        return $result;
    }

    /**
     * Get basic salary for all staffs
     * @return type
     */
    public function getbasicsalary() {
        try {
            $sql = "select basic_salary,member_id from salary_master";
            //echo $sql;exit;
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $exc) {
            echo $exc;
        }
        // print_r($exc);exit;
        return $row;
    }

    /**
     * calculate basic salary for the whole year
     * @param type $param
     */
    public function calculate_salary($param) {
        //print_r($param);
        try {
            $salary_yr = array();
            $deduce_amount = array();
            foreach ($param as $value) {
                $salary_yr = $value['basic_salary'] * 12;
                $basic_deduction = $salary_yr * (20 / 100);
                $emp_ssc = $salary_yr * (2 / 100);
                //echo $salary_yr.'<br>'.$emp_ssc;exit;
                $deduce_amount = $this->getreduce($value['member_id']);
                //echo $salary_yr.'<br>';
                //print_r($deduce_amount[0]['Totalamount']);
                $total_deduce = $deduce_amount[0]['Totalamount'] + $basic_deduction + $emp_ssc;
                $income_tax = $salary_yr - $total_deduce;
                echo $income_tax.'<br>';
                //echo "Member id " . $value['member_id'] . "The latest salary is " . $latest_result . '<br>';
                // echo "greater";
                $this->deducerate($income_tax);
            }
            exit;
            //print_r($deduce_amount);exit;
        } catch (Exception $exc) {
            echo $exc;
        }
    }

    /**
     * calculate reduce rate
     * @param type $member_id
     */
    public function getreduce($member_id) {
        //print_r($member_id);exit;
        try {

            $sql = "select SUM(amount) Totalamount from taxs_deduction where deduce_id in (select deduce_id from core_member_tax_deduce where member_id='" . $member_id . "')";
            //echo $sql;exit;
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * calculate the rate of income tax
     * @param type $b_salary
     */
    public function deducerate($income_tax) {
        //echo $income_tax; //exit;
        try {
            $sql = "select * from taxs where taxs_from<".$income_tax." and taxs_rate !=0 ORDER BY `taxs_to` DESC limit 2";
            //$sql = "select taxs_to,taxs_from,taxs_rate from taxs where taxs_rate !=0";
            //echo $sql;//exit;
            $result = $this->db->query($sql);
            $rows = $result->fetchall();
            //print_r($rows);
            $this->calculate_deducerate($rows,$income_tax);

            //exit;
        } catch (Exception $exc) {
            echo $exc;
        }
        return $rows;
    }
    
    public function calculate_deducerate($rows,$income_tax) {
        
           foreach($rows as $element) {
    if ($element === reset($rows))
    { //echo 'FIRST ELEMENT!  '.$element['taxs_from'].'<br>';
        $aa=$element['taxs_from']-1;
        $first_num= ($income_tax-$aa)*($element['taxs_rate']/100);
        echo "first result ".$first_num.'<br>';
    }   
    if ($element === end($rows))
    { //echo 'LAST ELEMENT! '.$element['taxs_to'];
        $taxs_to=$element['taxs_to'];
        $taxs_rate=$element['taxs_rate'];
        $result=($taxs_to)*($taxs_rate/100);
        echo "the second result is ".$result;
         $resultrate=$first_num+$result;
         //echo 'The Latest Result is '.$resultrate.'<br>';
    }
   
    
    
}
    }

}
