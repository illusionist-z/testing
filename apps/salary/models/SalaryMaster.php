<?php

namespace workManagiment\Salary\Models;

use Phalcon\Mvc\Model;
//use workManagiment\Salary\Models\SalaryMaster as sa;
use Phalcon\Mvc\Model\Query;
use workManagiment\Salary\Models\CoreMemberTaxDeduce;

class SalaryMaster extends Model {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * save salary to salary master
     * @return type
     * @author zinmon
     */
    public function savesalary($data) {
        try {
//            $sql = "INSERT INTO salary_master (id,member_id,position,basic_salary,travel_fee,over_time,created_dt) VALUES(uuid(),'" . $data['member_id'] . "','".$data['position']. "','". $data['basic_salary'] . "','" . $data['travelfee'] . "','" . $data['overtime'] . "',NOW())";
//            $result = $this->db->query($sql);
            $SalaryMaster = new SalaryMaster();
            $SalaryMaster->save($data);
//            if ($SalaryMaster->save($data) == false) {
//                echo "Umh, We can't store robots right now ";
//                foreach ($SalaryMaster->getMessages() as $message) {
//                    echo $message;
//                }
//            } else {
//                echo "Great, a new robot was saved successfully!";
//            }
        } catch (Exception $e) {
            echo $e;
        }

        return $result;
    }

    /**
     * Save salary dedution amount to core_member_tax_deduce
     * @param type $dedution
     * @return type
     */
    public function savesalarydedution($dedution, $member_id, $creator_id) {
        try {
            
            for ($i = 0; $i < count($dedution); $i++) {

                $sql = "INSERT INTO workManagiment\Salary\Models\CoreMemberTaxDeduce 
                        (deduce_id,member_id,creator_id, created_dt,updater_id,updated_dt,deleted_flag)
                        VALUES('" . $dedution[$i] . "','" . $member_id . "', '" 
                        . $creator_id . "',NOW(),0,'00:00:00',0)";
                $result = $this->modelsManager->executeQuery($sql);
            }
        } catch (Exception $e) {
            echo $e;
        }

        //return $result;
    }

    /**
     * Get basic salary for all staffs
     * @return type
     */
    public function getbasicsalary() {
        try {
            $sql = "select basic_salary,member_id,date(created_dt)as comp_start_date "
                    . "from salary_master where deleted_flag=0";
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

        try {
            $salary_yr = array();
            $deduce_amount = array();
            $now = new \DateTime('now');
            $budget_startyear = $now->format('Y') . '-04';
            $endyear = $now->format('Y') . '-03';
            $budget_endyear = date("Y-m", strtotime("+1 year", strtotime($endyear)));
            $allowance="";
            foreach ($param as $value) {
                //$comp_start_date = $value['comp_start_date'];
                $comp_start_date = '2015-08';
                $SM = $this->getLatestsalary($value['member_id']);
                $SD = $this->checkBasicsalaryBymember_id('salary_detail',
                        $value['member_id'], $budget_startyear, $budget_endyear);
                //Check there is allowance or not
                $Allowanceresult = $this->getAllowances($value['member_id']);
                if(isset($Allowanceresult['total_allowance_amount']))
                   {
                    $allowance=$Allowanceresult['total_allowance_amount'];
                   }
                   else{
                       $allowance=0;
                   }
                echo $SM['basic_salary'] . '<br>';
                if ($comp_start_date > $budget_startyear && $comp_start_date < $budget_endyear && empty($SD)) {
                    $date_diff = $this->date_difference($comp_start_date, $budget_endyear);

                    $salary_yr = $value['basic_salary'] * $date_diff;
                    echo "NEW" . $date_diff . '<br><br>';
                }
                //Restart from start date
                //if (date("Y-m") == $budget_startyear) {
                if ($comp_start_date == $budget_startyear) {
                    $get_latest_salary = $this->getLatestsalary($value['member_id']);
                    $salary_yr = $get_latest_salary['basic_salary'] * 12;
                    $date_diff = 12;
                    //echo "Next year";
                }


                //Check the wherether  the member is got salary or new member
                $checkmember = $this->checkmember_id($value['member_id']);
                if (!empty($checkmember)) {
                    //echo 'The member_id is in salary detail';
                    if ($SM['basic_salary'] != $SD['basic_salary']) {
                        //If salary is increased or changed
                        $date_diff = $this->date_difference($SM['updated_dt'], $budget_endyear);
                        $newsalary_rate = $SM['basic_salary'] * $date_diff;
                        $countsalarydetail = $this->getCountSalarydetail(
                                $budget_startyear, $budget_endyear, $value['member_id']);
                        $old_payamount = $countsalarydetail['pay_amount'];
                        $date_diff+=$countsalarydetail['COUNT'];
                        $salary_yr = $newsalary_rate + $old_payamount;
                       echo "Not EQUAl".$date_diff."<br><br>";
                    }
                }


                   
                if ($SM['basic_salary'] == $SD['basic_salary'] && 
                    date("Y-m") > $budget_startyear && date("Y-m") <= $budget_endyear 
                    && $SD['allowance_amount']==$allowance)
                {
                    echo "===";
                    $check_salary_detail = $this->getsalarydetail_check($value['member_id']);
                    //print_r($check_salary_detail);
                    $final_result[] = array('income_tax' => $check_salary_detail['income_tax'], 
                                      'member_id' => $check_salary_detail['member_id']);
                } else {
                    
                //Insert new allowance to add to basic salary
                if (!empty($Allowanceresult)) {
//                    $total_allowances = "";
                    //print_r($result);
//                    for ($i = 0; $i < count($result); $i++) {
//                        $total_allowances+=$result[$i]['allowance_amount'];
//                    }
                    //$salary_yr+=$total_allowances;
                    //echo "DDD".$Allowanceresult['total_allowance_amount'];
                    if(empty($SD['allowance_amount']) && isset($Allowanceresult['total_allowance_amount'])){
                    $allowance=$Allowanceresult['total_allowance_amount'];
                    $salary_yr+=$allowance;
                    echo $salary_yr.'empty allowance';
                    
                    }
                    else if($SD['allowance_amount']!=$allowance)
                    {
                    //echo "AAAA".$salary_yr;
                    $salary=$allowance+$salary_yr;
                     //echo $salary.'///';
//                    if ($comp_start_date > $budget_startyear && $comp_start_date < $budget_endyear) {
//                    $date_diff = $this->date_difference($comp_start_date, $budget_endyear);
//                    
//                        
//                    }
//                    if ($comp_start_date == $budget_startyear) {    
//                    $date_diff = 12;
//                    //echo "BB";
//                    }
                   
                    //$date_diff = $this->date_difference($comp_start_date, $budget_endyear);
                   
                    }
                }
                    
                    //echo 'SALARY'.$date_diff;
                    //$salary_yr = $value['basic_salary'] * 12;
                    //get 20% for the whole year
                    $basic_deduction = $salary_yr * (20 / 100);
                    //echo $basic_deduction.'.............';
                    //calculate ssc pay amount to deduce
                    if ($value['basic_salary'] > 300000) {
                        $emp_ssc = (300000 * 12) * (2 / 100);
                    } else {
                        $emp_ssc = ($value['basic_salary'] * 12) * (2 / 100);
                    }

                    $deduce_amount = $this->getreduce($value['member_id']);
                    
                    //echo $deduce_amount[0]['member_id'].' '.$deduce_amount[0]['Totalamount'].' '.$basic_deduction.' '.$emp_ssc;echo "<br>";
                    //Total deduction (deduce,20%,ssc)
                    $total_deduce = $deduce_amount[0]['Totalamount'] + $basic_deduction + $emp_ssc;
                    //echo $total_deduce;
                    
                    //taxable income (total_basic-total deduce)
                    $income_tax = $salary_yr - $total_deduce;

                    //echo "Member id " . $salary_yr . "The latest salary is " . $income_tax . '<br>';

                    $taxs = $this->deducerate($income_tax, $date_diff);
                    //print_r($taxs);
                    $final_result[] = array('income_tax' => $taxs, 
                                      'member_id' => $value['member_id'], 'allowance_amount' => $allowance);
                }
            }
            //print_r($final_result);
            //exit;
            //print_r($deduce_amount);exit;
        } catch (Exception $exc) {
            echo $exc;
        }
        return $final_result;
    }

    /**
     * Get the latest basic salary from last year
     * @param type $member_id
     * @return type
     */
    public function getLatestsalary($member_id) {
        try {

            $sql = "select * from salary_master where member_id='" . $member_id . "' and deleted_flag=0";

            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * calculate date difference
     * @param type $date_difference
     * @param type $budget_endyear
     * @return type
     */
    public function date_difference($date_difference, $budget_endyear) {
        $datetime1 = date_create($date_difference);
        $datetime2 = date_create($budget_endyear);
        $interval = date_diff($datetime1, $datetime2);
        $diff_date = $interval->format('%m');
        
        $salary_year = $diff_date + '2';
        return $salary_year;
    }

    /**
     * get the previous salary detail
     * @return type
     */
    public function getsalarydetail_check($member_id) {
        try {

            $sql = "select * from salary_detail where member_id='" . $member_id . "' order by created_dt DESC";

            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * Get Allowance
     * @param type $member_id
     * @return type
     */
    public function getAllowances($member_id) {
        try {

            $sql = "select *,SUM(allowance_amount) as total_allowance_amount from allowances where allowance_id in (
select allowance_id from salary_master_allowance where member_id='" . $member_id . "')";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
            //print_r($row);//exit;
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    //Check basic salary By member
    public function checkBasicsalaryBymember_id($tbl, $member_id, $budget_startyear, $budget_endyear) {
        try {
            if (date("Y-m-d") < $budget_startyear) {
                $sql = "select * from " . $tbl . " where member_id='" . $member_id . "'and DATE(created_dt)<'" . $budget_startyear . "' order by created_dt desc limit 1";
            } else {
                $sql = "select * from " . $tbl . " where member_id='" . $member_id . "'and DATE(created_dt)>='" . $budget_startyear . "' and DATE(created_dt)<='" . $budget_endyear . "' order by created_dt desc limit 1";
                
            }
            
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
           
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    public function getCountSalarydetail($budget_startyear, $budget_endyear, $member_id) {
        try {
            if (date("Y-m-d") < $budget_startyear) {
                $last_budget_startyear = date("Y-m-d", strtotime("-1 year", strtotime($budget_startyear)));
                $sql = "select *,count(pay_date) as COUNT, SUM(basic_salary)as pay_amount from salary_detail where member_id='" . $member_id . "' and pay_date>='" . $last_budget_startyear . "' and pay_date<'" . $budget_startyear . "'";
            } else {
                $sql = "select *,count(pay_date) as COUNT, SUM(basic_salary)as pay_amount from salary_detail where member_id='" . $member_id . "' and pay_date>='" . $budget_startyear . "' and pay_date<='" . $budget_endyear . "'";
                //echo $sql.'<br>';
            }
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
            //print_r($row);
            //exit;
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
        echo 'Year difference '.$Result.' ////';

        $latest_result = round($Result / $salary_year);
        return $latest_result;
    }

    /**
     * Calaculate for employee
     * @return type
     */
    public function calculate_overtime() {
        try {
            $year=date("Y");
            $month=date("m");
            $sql = "select ATT .member_id,round(ATT.overtime*(SA.basic_salary*SA.over_time/100))as overtime_rate,
                SA.basic_salary,SA.travel_fee from attendances  as ATT join salary_master as SA 
                on ATT.member_id=SA.member_id where ATT .member_id
in (select member_id from salary_master) and YEAR(ATT.att_date)='".$year."' and "
                    . "MONTH(ATT.att_date)='".$month."' group by ATT .member_id";
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

    /**
     *
     * @param type $member_id
     */
    public function editsalary($member_id) {
        try {
            $sql = "select * from salary_master left join core_member on salary_master.member_id=core_member.member_id where salary_master.id ='" . $member_id . "'";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * @author David
     * @return $res[]?true :false
     * Salary Edit action
     */
    public function btnedit($data) {
        $res = array();
        $res['baseerr'] = filter_var($data['basesalary'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^([\d])/'))) ? true : false;

        $res['travelerr'] = filter_var($data['travelfee'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^([\d])/'))) ? true : false;

        $res['overtimerr'] = preg_match('/^(?=.*\d)[0-9]*$/', $data['overtime']) ? true : false;      //validate empty field and not number
        //if not valid return false
        $res['sscemp'] = preg_match('/^(?=.*\d)[0-9]*$/', $data['ssc_emp']) ? true : false;

        $res['ssccomp'] = preg_match('/^(?=.*\d)[0-9]*$/', $data['ssc_comp']) ? true : false;

        if ($res['baseerr'] && $res['travelerr'] && $res['overtimerr'] && $res['sscemp'] && $res['ssccomp']) {
            try {
                $sql = "Update salary_master SET basic_salary ='" . $data['basesalary'] . "',travel_fee ='" . $data['travelfee'] . "',over_time ='" . $data['overtime'] . "',ssc_emp ='" . $data['ssc_emp'] . "',ssc_comp ='" . $data['ssc_comp'] . "',updated_dt=NOW() Where id='" . $data['id'] . "'";
                $this->db->query($sql);
                $res['valid'] = true;
            } catch (Exception $ex) {
                echo $ex;
            }
        } else {
            $res['valid'] = false;
        }
        return $res;
    }

}
