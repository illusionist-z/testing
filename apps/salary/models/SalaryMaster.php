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
    public function calculate_tax_salary($param) {
        //print_r($param);exit;
        try {
            $salary_yr = array();
            $deduce_amount = array();
            foreach ($param as $value) {
                $salary_yr = $value['basic_salary'] * 12;
                $basic_deduction = $salary_yr * (20 / 100);
                if($value['basic_salary']>300000)
                {
                    $emp_ssc = (300000*12) * (2 / 100);
                }
                else{
                $emp_ssc = $salary_yr * (2 / 100);
                }
                //echo "salary for the whole year ".$salary_yr.' basic deduction is '.$basic_deduction.' ssc for employee '.$emp_ssc.'<br>';
                $deduce_amount = $this->getreduce($value['member_id']);
              
                //echo $deduce_amount[0]['member_id'].' '.$deduce_amount[0]['Totalamount'].' '.$basic_deduction.' '.$emp_ssc;echo "<br>";
                $total_deduce = $deduce_amount[0]['Totalamount'] + $basic_deduction + $emp_ssc;
                //echo "Total deducion is ".$total_deduce;
                $income_tax = $salary_yr - $total_deduce;
                //echo "INCOME ".$income_tax . '<br>';
                //echo "Member id " . $value['member_id'] . "The latest salary is " . $latest_result . '<br>';
                // echo "greater";
                $taxs= $this->deducerate($income_tax);
                $final_result[] = array('income_tax' => $taxs,'member_id'=>$deduce_amount[0]['member_id']);
                //$final_result['income_tax'] = $income_tax;
                //array_push($final_result,$final_result['member_id']=$deduce_amount[0]['member_id']);
                //array_push($final_result['member_id'], 'wagon');
            }
//            print_r($final_result);
//            exit;
            //print_r($deduce_amount);exit;
        } catch (Exception $exc) {
            echo $exc;
        }
        return $final_result;
    }

    /**
     * calculate reduce rate
     * @param type $member_id
     */
    public function getreduce($member_id) {
        //echo $member_id.'<br><br>';
        try {
            
            $sql = "select SUM(amount) Totalamount, TD.*,CMT.member_id from taxs_deduction as TD join core_member_tax_deduce as CMT on TD.deduce_id=CMT.deduce_id where CMT.deduce_id in (select deduce_id from core_member_tax_deduce CMTD where CMTD.member_id='".$member_id."')and CMT.member_id='".$member_id."'";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            //print_r($row);exit;
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
        //echo "bbbbbbbbbbbb ".$income_tax; //exit;
        try {
            $sql = "select * from taxs where taxs_from<" . $income_tax . " and taxs_rate !=0";
            //$sql = "select taxs_to,taxs_from,taxs_rate from taxs where taxs_rate !=0";
            //echo $sql.'<br>';//exit;
            $result = $this->db->query($sql);
            $rows = $result->fetchall();
            //print_r($rows);
            $taxsrate_data = array();
            foreach ($rows as $element) {

                $taxsrate_data[] = $element['taxs_diff'] . ' ' . $element['taxs_rate'];
            }
            //print_r($taxsrate_data);
            $rows = $this->calculate_deducerate($taxsrate_data, $income_tax);
            //print_r($rows);
            //exit;
        } catch (Exception $exc) {
            echo $exc;
        }
        return $rows;
    }

    /**
     * calculate deduce rate for tax
     * @param type $taxsrate_data
     * @param type $income_tax
     */
    public function calculate_deducerate($taxsrate_data, $income_tax) {
        $latest_rateval = end($taxsrate_data);
        $start_rateval = reset($taxsrate_data);
        $first_result = "";
        $second_result = "";
        $first_result_first = "";
        $Result = '';
        //print_r($taxsrate_data);
        if (count($taxsrate_data) > 1) {
            for ($i = 0; $i < count($taxsrate_data); $i++) {
                $taxs_rate = explode(" ", $taxsrate_data[$i]);

                if ($taxsrate_data[$i] == $latest_rateval) {
                    $first_result = ($income_tax - $latest_rateval) * ($taxs_rate[1] / 100);

                    if ($income_tax > 30000000) {
                        $first_result = ($income_tax - 30000000) * ($taxs_rate[1] / 100);
                    }
                    //echo 'Final '.$first_result."<br>"; 
                } else {
                    $second_result+=$taxs_rate[0] * ($taxs_rate[1] / 100);
                }
                //echo $second_result.'<br>';
            }
            $Result = $first_result + $second_result;
            //echo "Final result ".$Result.'<br>';
        } else {
            for ($i = 0; $i < count($taxsrate_data); $i++) {
                $taxs_rate = explode(" ", $taxsrate_data[$i]);
                $todeduce = $taxs_rate[0] - 1000000;
                $Result = ($income_tax - $todeduce) * ($taxs_rate[1] / 100);
                //echo "R".$Result.'<br>';
            }
        }
        $latest_result=round($Result/12);
        return $latest_result;
    }

    /**
     * Calaculate for employee
     * @return type
     */
    public function calculate_overtime() {
        try {
            $sql = "select ATT .member_id,round(ATT.overtime*(SA.basic_salary*SA.over_time/100))as overtime_rate,SA.basic_salary,SA.travel_fee from attendances  as ATT join salary_master as SA on ATT.member_id=SA.member_id where ATT .member_id
in (select member_id from salary_master) group by ATT .member_id";
            //$sql = "select taxs_to,taxs_from,taxs_rate from taxs where taxs_rate !=0";
            //echo $sql;exit;
            $result = $this->db->query($sql);
            $rows = $result->fetchall();
            //print_r($rows);exit;
        } catch (Exception $exc) {
            echo $exc;
        }
        return $rows;
    }
    
    /**
     * Calculate ssc for employer and employee
     * @return type
     */
    public function sscforCompandEmp() {
        try {
            $sql = "select member_id, 
    (
    CASE 
        WHEN basic_salary > '300000' THEN ('300000'*ssc_emp/100)
        WHEN basic_salary <= '300000' THEN (basic_salary *ssc_emp/100)
        END) AS ssc_emp,
     (
    CASE 
        WHEN basic_salary > '300000' THEN ('300000'*ssc_comp/100)
        WHEN basic_salary <= '300000' THEN (basic_salary *ssc_comp/100)
        END) AS ssc_comp
 from salary_master";
            //echo $sql;
            $result = $this->db->query($sql);
            $rows = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
        return $rows;
    }

}
