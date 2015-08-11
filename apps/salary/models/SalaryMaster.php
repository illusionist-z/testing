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

            $sql = "INSERT INTO salary_master (id,member_id,position,basic_salary,travel_fee,over_time) VALUES(uuid(),'" . $data['member_id'] . "','" . $data['position'] . "','" . $data['basic_salary'] . "','" . $data['travelfee'] . "','" . $data['overtime'] . "')";
            //echo $sql;exit;
            $result = $this->db->query($sql);
        } catch (Exception $e) {
            echo $e;
        }

        return $result;
    }

    /**
     * Save salary dedution amount to core_member_tax_deduce
     * @param type $dedution
     * @return typ
     */
    public function savesalary_dedution($dedution, $member_id) {
        try {
            //print_r($dedution);exit;
            for ($i = 0; $i < count($dedution); $i++) {
                $sql = "INSERT INTO core_member_tax_deduce (deduce_id,member_id,created_dt) VALUES('" . $dedution[$i] . "','" . $member_id . "',NOW())";
                $result = $this->db->query($sql);
            }
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
            $sql = "select basic_salary,member_id,date(created_dt)as comp_start_date from salary_master";
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
        //print_r($param); //exit;
        try {
            $salary_yr = array();
            $deduce_amount = array();
            foreach ($param as $value) {
                $comp_start_date = $value['comp_start_date'];
                $now = new \DateTime('now');
                // budget year
                $budget_endyear = $now->format('Y') . '-05-31';
                $budget_startyear = $now->format('Y') . '-04-01';
                //Check the wherether  the member is got salary or new member
                $checkmember = $this->checkmember_id($value['member_id']);
                if (!empty($checkmember)) {
                    //echo 'The member_id is in salary detail';
                    $SM = $this->checkBasicsalaryBymember_id('salary_master', $value['member_id']);

                    $SD = $this->checkBasicsalaryBymember_id('salary_detail', $value['member_id']);

                    if ($SM['basic_salary'] == $SD['basic_salary']) {
                        $next_budget_year = date("Y-m-d", strtotime("+1 year", strtotime($budget_endyear)));
                        $datetime1 = date_create($SD['pay_date']);
                        $datetime2 = date_create($next_budget_year);
                        $interval = date_diff($datetime1, $datetime2);
                        $salary_year = $interval->format('%m');
                        $salary_yr = $SD['basic_salary'] * $salary_year;
                    } else {

                        //If salary is increased or changed
                        $next_budget_year = date("Y-m-d", strtotime("+1 year", strtotime($budget_endyear)));
                        $datetime1 = date_create($SM['updated_dt']);
                        $datetime2 = date_create($next_budget_year);
                        $interval = date_diff($datetime1, $datetime2);
                        $salary_year = $interval->format('%m');

                        //calculate new salary rate
                        $newsalary_rate = $SM['basic_salary'] * $salary_year;
                        $countsalarydetail = $this->getCountSalarydetail($budget_startyear, $value['member_id']);
                        //echo $value['member_id'].'<br>';
                        $oldsalary_rate = $countsalarydetail['basic_salary'] * $countsalarydetail['COUNT'];
                        $salary_yr = $newsalary_rate + $oldsalary_rate;
                        //echo $salary_year;
                    }
                } else {
                    if ($comp_start_date > $budget_endyear) {

                        $next_budget_year = date("Y-m-d", strtotime("+1 year", strtotime($budget_endyear)));
                        $datetime1 = date_create($comp_start_date);
                        $datetime2 = date_create($next_budget_year);
                        $interval = date_diff($datetime1, $datetime2);
                        $salary_year = $interval->format('%m');
                        $salary_yr = $value['basic_salary'] * $salary_year;
                    } else {

                        $datetime1 = date_create($comp_start_date);
                        $datetime2 = date_create($budget_endyear);
                        $interval = date_diff($datetime1, $datetime2);
                        $salary_year = $interval->format('%m');
                        $salary_yr = $value['basic_salary'] * $salary_year;
                    }
                }

                //$salary_yr = $value['basic_salary'] * 12;
                //get 20% for the whole year
                $basic_deduction = $salary_yr * (20 / 100);
                
                //Check there is allowance or not
                $result=$this->getAllowances($value['member_id']);
                if(!empty($result))
                {
                    $total_allowances="";
                    //print_r($result);
                    for($i=0;$i<count($result);$i++){
                        $total_allowances+=$result[$i]['allowance_amount'];
                        
                    }
                  //echo $total_allowances;
                }
                
                
                
                //calculate ssc pay amount to deduce
                if ($value['basic_salary'] > 300000) {
                    $emp_ssc = (300000 * 12) * (2 / 100);
                } else {
                    $emp_ssc = ($value['basic_salary'] * 12) * (2 / 100);
                }

                $deduce_amount = $this->getreduce($value['member_id']);
                
                //echo $deduce_amount[0]['member_id'].' '.$deduce_amount[0]['Totalamount'].' '.$basic_deduction.' '.$emp_ssc;echo "<br>";
                $total_deduce = $deduce_amount[0]['Totalamount'] + $basic_deduction + $emp_ssc;
                echo "Total deducion is " . $basic_deduction . 'bbbbbbbbb' . $salary_yr;
                $income_tax = $salary_yr - $total_deduce;
                echo "INCOME " . $income_tax . '<br>';
                //echo "Member id " . $value['member_id'] . "The latest salary is " . $latest_result . '<br>';
                // echo "greater";
                $taxs = $this->deducerate($income_tax, $salary_year);
                $final_result[] = array('income_tax' => $taxs, 'member_id' => $deduce_amount[0]['member_id']);
                //$final_result['income_tax'] = $income_tax;
                //array_push($final_result,$final_result['member_id']=$deduce_amount[0]['member_id']);
                //array_push($final_result['member_id'], 'wagon');
            }
//            print_r($final_result);
            //exit;
            //print_r($deduce_amount);exit;
        } catch (Exception $exc) {
            echo $exc;
        }
        return $final_result;
    }
    
    /**
     * Get Allowance
     * @param type $member_id
     * @return type
     */
    public function getAllowances($member_id) {
        try {

            $sql = "select * from allowances where allowance_id in (
select allowance_id from salary_master_allowance where member_id='" . $member_id . "')";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            //print_r($row);//exit;
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    //Check basic salary By member
    public function checkBasicsalaryBymember_id($tbl, $member_id) {
        try {

            $sql = "select * from " . $tbl . " where member_id='" . $member_id . "' order by created_dt desc limit 1";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
            //print_r($row);//exit;
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    public function getCountSalarydetail($budget_startyear, $member_id) {
        try {

            $sql = "select *,count(pay_date) as COUNT from salary_detail where member_id='" . $member_id . "' and pay_date>'" . $budget_startyear . "'";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
            //print_r($row);//exit;
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * check memberid whether is in salary detail table
     * @param type $member_id
     * @return type
     */
    public function checkmember_id($member_id) {
        try {

            $sql = "select pay_date from salary_detail where member_id='" . $member_id . "'";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            //print_r($row);//exit;
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * calculate reduce rate
     * @param type $member_id
     */
    public function getreduce($member_id) {
        //echo $member_id.'<br><br>';
        try {

            $sql = "select SUM(amount) Totalamount, TD.*,CMT.member_id from taxs_deduction as TD join core_member_tax_deduce as CMT on TD.deduce_id=CMT.deduce_id where CMT.deduce_id in (select deduce_id from core_member_tax_deduce CMTD where CMTD.member_id='" . $member_id . "')and CMT.member_id='" . $member_id . "'";
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
    public function deducerate($income_tax, $salary_year) {
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
            $rows = $this->calculate_deducerate($taxsrate_data, $income_tax, $salary_year);
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
    public function calculate_deducerate($taxsrate_data, $income_tax, $salary_year) {
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
            }
        }

        $latest_result = round($Result / 12);
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
