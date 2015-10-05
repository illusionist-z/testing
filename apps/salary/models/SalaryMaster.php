<?php

namespace workManagiment\Salary\Models;

use Phalcon\Mvc\Model;
//use workManagiment\Salary\Models\SalaryMaster as sa;
use Phalcon\Mvc\Model\Query;
use workManagiment\Salary\Models\SalaryMemberTaxDeduce;

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

        
    }

    /**
     * Save salary dedution amount to core_member_tax_deduce
     * @param type $dedution
     * @return type
     */
    public function savesalarydedution($dedution, $member_id, $creator_id) {
        try {
            
            for ($i = 0; $i < count($dedution); $i++) {

                $sql = "INSERT INTO workManagiment\Salary\Models\SalaryMemberTaxDeduce 
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
            $sql = "select basic_salary,status,member_id,travel_fee,date(created_dt)as comp_start_date "
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
            $salary = "";
            $absent_deduce="";
            $deduce_amount = array();
            $now = new \DateTime('now');
            $budget_startmonth ='04';
            $budget_startyear =$now->format('Y').'-04';
            $budget_endmonth = '03';
            $endyear = $now->format('Y') . '-03';
            $budget_endyear = date("Y-m", strtotime("+1 year", strtotime($endyear)));
            $allowance="";
            foreach ($param as $value) {
                
                $start_date = explode("-", $value['comp_start_date']);
                $comp_start_date=$start_date[0].'-'.$start_date[1];
                $comp_start_month = $start_date[1];
                $SM = $this->getLatestsalary($value['member_id']);
                $SD = $this->checkBasicsalaryBymember_id('salary_detail',
                        $value['member_id'], $budget_startyear, $budget_endyear);
                $latest_payday='0';
                if(!empty($SD)){
                $payday=  explode("-", $SD['pay_date']);
                $latest_payday=$payday[1];
                $update=  explode(" ", $SM['updated_dt']);
                $dt=  explode("-", $update[0]);
                $up_date=$dt[0].'-'.$dt[1];}
                //Check there is allowance or not
                $Allowanceresult = $this->getAllowances($value['member_id']);
                if(isset($Allowanceresult['total_allowance_amount']))
                   {
                    $allowance=$Allowanceresult['total_allowance_amount'];
                   }
                   else{
                       $allowance=0;
                   }
                echo "basic salary".$value['basic_salary'].'<br>';
                //check the user who is absent.
                $absent=  $this->checkAbsent($value['member_id']);
                $leavesetting=  $this->getleavesetting();
                if($absent['countAbsent']>$leavesetting['max_leavedays']){
                    if($leavesetting['fine_amount']!="")
                    {
                      $salary_per_day=  $SM['basic_salary']*$leavesetting['fine_amount']/100;
                      $absent_deduce=$salary_per_day*$absent['countAbsent'];
                      
                    }
                    else{
                    $salary_per_day=$SM['basic_salary']/22;
                    $absent_deduce=$salary_per_day*$absent['countAbsent'];
                    
                    }
                }
                else{
                    $absent_deduce=0;
                }
               //For starting month for salary calculating
                if($value['status']==0)
                {  
                    if($comp_start_month==$budget_startmonth or $latest_payday==$budget_startmonth){
                        $date_diff=12;
                        $salary=($SM['basic_salary']*$date_diff)-$absent_deduce;
                        //echo "new year ";
                    }
                    //echo $budget_startyear;
                    if($comp_start_date>$budget_startyear && $comp_start_date<$budget_endyear  && empty($SD)){
                        $date_diff=$this->date_difference($comp_start_date,$budget_endyear);
                        $salary=($SM['basic_salary']*$date_diff)-$absent_deduce;
                        //echo "aa".$salary.'<br>';
                    }
                    if($comp_start_month==$budget_endmonth && $SD['basic_salary']==""){
                        $salary=$SM['basic_salary']-$absent_deduce;
                        $this->change_status($value['member_id']);
                       
                    }
                
                }
                //After company starting one year
                if($value['status']==1){
                   
                        $date_diff=12;
                        $salary=($SM['basic_salary']*$date_diff)-$absent_deduce;
                    
                    
                }
                
                //change status for new year
                if($latest_payday=='03')
                {
                   $this->change_status($value['member_id']);
                }
                //Check the wherether  the member is got salary or new member
                $checkmember = $this->checkmember_id($value['member_id']);
                if (!empty($checkmember)) {
                    //echo 'The member_id is in salary detail';
                    if ($SM['basic_salary'] != $SD['basic_salary'] && $value['status']==0) {
                        
                        //If salary is increased or changed
                        $date_diff = $this->date_difference($up_date, $budget_endyear);
                        $newsalary_rate = $SM['basic_salary'] * $date_diff;
                        //echo "New salary ".$newsalary_rate;
                        $countsalarydetail = $this->getCountSalarydetail(
                                $budget_startyear, $budget_endyear, $value['member_id']);
                        $old_payamount = $countsalarydetail['pay_amount'];
                        $date_diff+=$countsalarydetail['COUNT'];
                        $salary = ($newsalary_rate + $old_payamount)-$absent_deduce;
                        //echo "M ID ".$value['member_id']."Not EQUAl".$salary."<br><br>";
                    }

                   if ($SM['basic_salary'] != $SD['basic_salary'] && $value['status']==1) {
                       $date_diff = $this->date_difference($up_date, $budget_endyear);
                        $newsalary_rate = $SM['basic_salary'] * $date_diff;
                        //echo "DDD".$newsalary_rate."GGG";
                        $countsalarydetail = $this->getCountSalarydetail(
                                $budget_startyear, $budget_endyear, $value['member_id']);
                        $old_payamount = $countsalarydetail['pay_amount'];
                        $date_diff+=$countsalarydetail['COUNT'];
                        $salary = ($newsalary_rate + $old_payamount)-$absent_deduce;
                       //echo "FFFFvv".$salary;
                   }
                }
                if ($SM['basic_salary'] == $SD['basic_salary'] 
                    && $SD['allowance_amount']==$allowance && $value['status']==0)
                {
                    //echo "notting<br>";
                    $check_salary_detail = $this->getsalarydetail_check($value['member_id']);
                    //print_r($check_salary_detail);
                    $final_result[] = array('income_tax' => $check_salary_detail['income_tax'], 
                                      'member_id' => $check_salary_detail['member_id'], 
                        'allowance_amount' => $check_salary_detail['allowance_amount'], 
                        'absent_dedution'=>$absent_deduce);
                } 
                else if ($SM['basic_salary'] == $SD['basic_salary'] 
                    && $SD['allowance_amount']==$allowance && $value['status']==1 && $latest_payday!='03')
                {
                    //echo "testing";
                    $check_salary_detail = $this->getsalarydetail_check($value['member_id']);
                    //print_r($check_salary_detail);
                    $final_result[] = array('income_tax' => $check_salary_detail['income_tax'], 
                                      'member_id' => $check_salary_detail['member_id'], 
                        'allowance_amount' => $check_salary_detail['allowance_amount'], 
                        'absent_dedution'=>$absent_deduce);
                } 
//                
                else {
                
                //Insert new allowance to add to basic salary
                if (!empty($Allowanceresult)) {

                    if(empty($SD['allowance_amount']) && isset($Allowanceresult['total_allowance_amount'])){
                    $allowance=$Allowanceresult['total_allowance_amount'];
                    $salary+=$allowance;;
                    //echo "ALLOWANCE";
                    }
                    else if($SD['allowance_amount']!=$allowance)
                    {
                    $date_diff = $this->date_difference($up_date, $budget_endyear);
                        $newsalary_rate = $SM['basic_salary'] * $date_diff;
                        
                        $countsalarydetail = $this->getCountSalarydetail(
                                $budget_startyear, $budget_endyear, $value['member_id']);
                        $old_payamount = $countsalarydetail['pay_amount'];
                        $date_diff+=$countsalarydetail['COUNT'];
                        $salary = $newsalary_rate + $old_payamount;
                        $salary=$allowance+$salary;
                     //echo $old_payamount.'///';

                   
                    }
                    else {
                        $salary=$allowance+$salary;
                        //echo $salary."Eain";
                    }
                }
                    
                    //get 20% for the whole year
                    $basic_deduction = $salary * (20 / 100);
                    //echo $basic_deduction.'.............';
                    //calculate ssc pay amount to deduce
                    if ($value['basic_salary'] > 300000) {
                        $emp_ssc = (300000 * 12) * (2 / 100);
                    } else {
                        $emp_ssc = ($value['basic_salary'] * 12) * (2 / 100);
                    }

                    $deduce_amount = $this->getreduce($value['member_id']);
                    
                    //echo 'Member_id'.$deduce_amount[0]['member_id'].' //// deducemount '.$deduce_amount[0]['Totalamount'].' '.$basic_deduction.' '.$emp_ssc;echo "<br>";
                    //Total deduction (deduce,20%,ssc)
                    $total_deduce = $deduce_amount[0]['Totalamount'] + $basic_deduction + $emp_ssc;
                    echo "Total deduction is ".$total_deduce;
                    
                    //taxable income (total_basic-total deduce)
                    $income_tax = $salary - $total_deduce;

                    //echo "Member id " . $salary_yr . "The Income tax  is " . $income_tax . '<br>';

                    $taxs = $this->deducerate($income_tax, $date_diff);
//                    print_r($taxs);
                    $final_result[] = array('income_tax' => $taxs, 
                                      'member_id' => $value['member_id'], 'allowance_amount' => $allowance, 
                        'absent_dedution'=>$absent_deduce);
                }
            }
            print_r($final_result);
            exit;
            //print_r($deduce_amount);exit;
        } catch (Exception $exc) {
            echo $exc;
        }
        return $final_result;
    }

    /**
     * get leave setting data
     */
    function getleavesetting() {
        try{
           
            $sql = "select * from leaves_setting";
            
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        }
        catch (Exception $ex){
            echo $ex;
        }
        return $row;
    }
    /**
     * check whether absent or not
     * @param type $member_id 
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    function checkAbsent($member_id) {
        try{
            $absent_deduce="";
            $getStartandEnd=  $this->getStartandEnd_date($member_id);
            $sql = "select count(date) as countAbsent from absent where member_id='" . $member_id . "' and date>='".$getStartandEnd['startDate']."' and date<='".$getStartandEnd['endDate']."' and deleted_flag=0";
            
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        }
        catch (Exception $ex){
            echo $ex;
        }
        return $row;
    }
    
    /**
     * get start and end date after 1 year
     * @param type $id
     * @return type
     */
   
     public function getStartandEnd_date($id){
        $sql="SELECT DATE(created_dt) as created_dt,DATE(working_year_by_year) as updated_dt FROM core_member WHERE core_member.member_id= '" . $id . "'";
        //echo $sql;
        $credt = $this->db->query($sql);
        $created_date = $credt->fetcharray();
        //print_r($created_date);
        if( $created_date['updated_dt']==NULL){
             $date['startDate']=$created_date['created_dt'];
             $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date['created_dt'])));
        }
        else{
             $date['startDate']=$created_date['updated_dt'];
            $date['endDate']=date('Y-m-d', strtotime("+1 year", strtotime($created_date['updated_dt'])));
        }
        
        return $date;
    }
    
    
    /**
     * change the status for next year
     * @param type $member_id
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function change_status($member_id) {
        try {
                $sql = "Update salary_master SET status =1 where member_id='".$member_id."'";
                //echo $sql;
                $this->db->query($sql);
            } catch (Exception $ex) {
                echo $ex;
            }
    }
    /**
     * Get the latest basic salary from last year
     * @param type $member_id
     * @return type
     */
    public function getLatestsalary($member_id) {
        try {
            $this->db = $this->getDI()->getShared("db");
            $sql = "select * from salary_master where member_id='" . $member_id . "' and deleted_flag=0";
            //echo $sql;exit;
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * Get today salary master for updating salary
     * @param type $member_id
     * @return type
     */
    function getTodaysalaryMaster($member_id) {
        try {
            $this->db = $this->getDI()->getShared("db");
            $sql = "select *,MONTH(updated_dt) as updatemonth from salary_master where member_id='" . $member_id . "' and deleted_flag=0 and DATE(updated_dt) = CURDATE()";
            //echo $sql;exit;
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

    public function date_difference_new($date_difference, $budget_endyear) {
        $datetime1 = date_create($date_difference);
        $datetime2 = date_create($budget_endyear);
        $interval = date_diff($datetime1, $datetime2);
        $diff_date = $interval->format('%m');
        
        $salary_year = $diff_date + '1';
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
//            if ($comp_start_date < $budget_startyear) {
//                $sql = "select * from " . $tbl . " where member_id='" . $member_id . "'and DATE(created_dt)<'" . $budget_startyear . "' order by created_dt desc limit 1";
//            } else {
//                $sql = "select * from " . $tbl . " where member_id='" . $member_id . "'and DATE(created_dt)>='" . $budget_startyear . "' and DATE(created_dt)<='" . $budget_endyear . "' order by created_dt desc limit 1";
//                
//            }
            $sql = "select * from " . $tbl . " where member_id='" . $member_id . "' order by created_dt desc limit 1";
           // echo $sql.'<br>';exit;
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

            $sql = "select SUM(amount) Totalamount, TD.*,CMT.member_id from salary_taxs_deduction as TD join salary_member_tax_deduce as CMT on TD.deduce_id=CMT.deduce_id where CMT.deduce_id in (select deduce_id from salary_member_tax_deduce CMTD where CMTD.member_id='" . $member_id . "')and CMT.member_id='" . $member_id . "'";
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
            echo "Final result ".$Result.'<br>';
        } else {

            for ($i = 0; $i < count($taxsrate_data); $i++) {
                $taxs_rate = explode(" ", $taxsrate_data[$i]);
                $todeduce = $taxs_rate[0] - 1000000;
                $Result = ($income_tax - $todeduce) * ($taxs_rate[1] / 100);
            }
        }
        echo 'Year difference '.$salary_year.' ////';

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
            $sql = "select * from salary_master LEFT JOIN core_member ON salary_master.member_id=core_member.member_id WHERE salary_master.id ='".$member_id."'";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * @author David JP <david.gnext@gmail.com>
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
    
    public function updatesalarydetail($bsalary,$overtimerate,$member_id) {
        try {
                $sql = "Update salary_master SET basic_salary ='" . $bsalary . "',over_time ='" . $overtimerate  . "',updated_dt=NOW() Where member_id='" . $member_id . "'";
                //echo $sql;exit;
                $this->db->query($sql);
                $res['valid'] = true;
            } catch (Exception $ex) {
                echo $ex;
            }
    }
}
