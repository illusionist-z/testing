<?php

namespace salts\Salary\Models;

use Phalcon\Mvc\Model;
//use salts\Salary\Models\SalaryMaster as sa;


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
            $return = array();
//            $sql = "INSERT INTO salary_master (id,member_id,position,basic_salary,travel_fee,over_time,created_dt) VALUES(uuid(),'" . $data['member_id'] . "','".$data['position']. "','". $data['basic_salary'] . "','" . $data['travelfee'] . "','" . $data['overtime'] . "',NOW())";
//            $result = $this->db->query($sql);
            $SalaryMaster = new SalaryMaster();           
           
            if ($SalaryMaster->save($data) == false) {               
                foreach ($SalaryMaster->getMessages() as $message) {
                    $return[] = $message;
                }                
            } else {
              $return [] =  "Data was saved successfully!";
            }
            return $return;
        } catch (Exception $e) {
           echo $e;
        }

        
    }

    /**
     * Save salary dedution amount to core_member_tax_deduce
     * @param type $dedution
     * @return type
     */
    public function savesalarydedution($dedution, $no_of_children, $member_id, $creator_id) {
        try {
            
            for ($i = 0; $i < count($dedution); $i++) {

                $sql = "INSERT INTO salts\Salary\Models\SalaryMemberTaxDeduce 
                        (deduce_id,member_id,creator_id, created_dt,updater_id,updated_dt)
                        VALUES('" . $dedution[$i] . "','" . $member_id . "', '" 
                        . $creator_id . "',NOW(),0,'00:00:00')";
                //echo $sql;exit;
                $result = $this->modelsManager->executeQuery($sql);
                
            }
             $sql="UPDATE salary_member_tax_deduce SET"
                . " no_of_children='" . $no_of_children. "' WHERE member_id='" . $member_id. "' and deduce_id='children'";
            
            $this->db->query($sql);
        } catch (Exception $e) {
            echo $e;
        }

        //return $result;
    }

    /**
     * Get basic salary for all staffs
     * @return type
     */
    public function getbasicsalary($countattday) {
        try { 
            $month=  date('m');
            $final = array();   
            foreach ($countattday as $countattdays) {
                $countatt = $countattdays['attdate'];
                $m_id = $countattdays['member_id'];
                $sql = "select *,(case when (travel_fee_perday) then travel_fee_perday*$countatt else travel_fee_permonth end) as travel_fee,salary_start_date as comp_start_date "
                    . "from salary_master where deleted_flag=0 and member_id='".$m_id."'";      
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            //$final[0]=$row;
            array_push($final, $row);
           
            }
            
        } catch (Exception $exc) {
            echo $exc;
        }
        // print_r($exc);exit;
        return $final;
    }

    /**
     * calculate basic salary for the whole year
     * @param type $param
     */
    public function calculate_tax_salary($param,$salary_start_date,$creator_id) {

        try {
            //print_r($param);exit;
            
            $deduce_amount = array();
            $now = new \DateTime('now');
            
//            $budget_startyear =$now->format('Y').'-04-01';
//            $budget_endyear_one = date("Y-m-d", strtotime("+1 year", strtotime($endyear)));
            $final_result="";
            $absent_dedution="";
            $date_diff="";
            $flg=0;
            foreach ($param as $value) {
                if(!empty($value)){
                $budget_startyear =$value[0]['salary_start_date'];
//                $bd_end=  explode('-', $value[0]['salary_end_date']);
//                $budget_endyear = $bd_end[0].'-'.$bd_end[1];
                $budget_endyear = $value[0]['salary_end_date'];
                //get the salary start date to calculate salary
                $start_date = explode("-", $value[0]['comp_start_date']);
                $salary_starting_date=$start_date[0].'-'.$start_date[1];
                $salary_starting_month = $start_date[1];
                //$w_startdt=  $this->getWorkingStartdt($value['member_id']);
                if($salary_start_date != "")
                {
                //get the working start date from core_member table
                $working_start_date = explode("-", $salary_start_date);
                $w_start_dt=$working_start_date[0].'-'.$working_start_date[1];
                
                    $comp_start_date=$w_start_dt;
                    $start_date = explode("-", $comp_start_date);
                    $salary_starting_date=$start_date[0].'-'.$start_date[1];
                    $salary_starting_month=$start_date[1];
                }
                    //calculate date difference between starting date and budget end year
                $date_diff=$this->date_difference($salary_start_date, $budget_endyear);
                $basic_salary_annual=$value[0]['basic_salary']*$date_diff; 
                $date_to_calculate=$date_diff;
                
                echo $value[0]['basic_salary'].'<br>';
                echo "salary starting date ".$budget_endyear.'<br>';
                //Get the basic salary which the latest pay in salary 
                $SD = $this->checkBasicsalaryBymember_id('salary_detail',
                        $value[0]['member_id'], $budget_startyear, $budget_endyear);
                //print_r($SD);
                //Get the basic salary from salary master
                $SM = $this->getLatestsalary($value[0]['member_id']);
               
                //get the latest
                $latest_otpay = $this->getlatestOTPay($value[0]['member_id'], $budget_startyear, $budget_endyear);
                
                if(!empty($SD))
                {
                    $basic_salary_annual=$basic_salary_annual+$SD['total_basic_salary'];
                    $old_allowance=$SD['total_all_amount'];
                    $date_to_calculate=$date_diff+$SD['count_pay'];
                    echo "basic salary in salary detail ".$SD['total_basic_salary'];
                }
               
                echo "OLD ALLOWANCE".$old_allowance.'<br>';
                $Allowanceresult = $this->getAllowances($value[0]['member_id'],$basic_salary_annual,$date_diff,$old_allowance,$SM['status'],$SD['allowance_amount'],$SD['count_pay']);
               
                $basic_salary_allowance_annual=$Allowanceresult['basic_salary_annual'];
                
                //calculating of overtime 
                $OTResult=$this->calculate_overtime_annual($value[0]['member_id'],$SD['total_overtime'],$salary_starting_date,$budget_endyear,$date_diff,$SD['count_pay'],$latest_otpay['overtime']);
                //$overtime=$this->calculate_overtime($value['member_id'],$salary_starting_date);
                //print_r($OTResult);
                $overtime_fees_annual=$OTResult['overtime_annual'];
                $overtime_fees=$OTResult['overtime'];
                
                $basic_salary_allowance_annual=$basic_salary_allowance_annual+$overtime_fees_annual;
                
                //check the user who is absent.
                $absent=  $this->checkAbsent($value[0]['member_id'],$budget_startyear,$budget_endyear);
                //Get the data of leave setting
                $leavesetting=  $this->getleavesetting();
                //calculate absent deduce
                $countabsent=$this->CalculateLeave($absent['countAbsent'], $leavesetting['max_leavedays'], $leavesetting['fine_amount'], $value[0]['basic_salary']);
                $absent_dedution=$countabsent;
                $basic_salary_allowance_annual = $basic_salary_allowance_annual-$absent_dedution;
                
                $basic_deduction = $basic_salary_allowance_annual * (20 / 100);
                    echo "SALARY ///".$basic_salary_allowance_annual;
                    if($flg != 1){
                    //calculate ssc pay amount to deduce
                    if ($value[0]['basic_salary'] > 300000) {
                        
                        $emp_ssc = (300000 * $date_to_calculate) * (2 / 100);
                    } else {
                        
                        $emp_ssc = ($value[0]['basic_salary'] * $date_to_calculate) * (2 / 100);
                    }
                    }
                    
                    $deduce_amount = $this->getreduce($value[0]['member_id']);
                    //print_r($deduce_amount).'<br>';
                    $total_deduce = $deduce_amount[0]['Totalamount'] + $basic_deduction + $emp_ssc;
                    echo "Total deduction is ".$basic_deduction;
                    
                    //taxable income (total_basic-total deduce)
                    $income_tax = $basic_salary_allowance_annual - $total_deduce;

                    echo "The Income tax  is " . $income_tax . '<br>';
                    $taxs = $this->deducerate($income_tax, $date_to_calculate);
                    $tax_foreach_month= $taxs['tax_result'];
//                  print_r($taxs);
                    if($flg==1){
                       
                        $tax_foreach_month=$taxs['total_tax_annual']-$total_income_tax;
                    }
                    
                    $final_result[] = array('basic_salary' => $value[0]['basic_salary'],
                        'income_tax' => $tax_foreach_month,
                        'total_annual_income' => $taxs['total_tax_annual'],
                        'travel_fee' => $value[0]['travel_fee'],
                        'overtime' => round($overtime_fees),
                        'basic_salary_annual' => $basic_salary_annual,
                        'basic_examption' => $basic_deduction,
                        'member_id' => $value[0]['member_id'], 
                        'allowance_amount' => $Allowanceresult['allowance'], 
                        'absent_dedution'=>  round($absent_dedution),
                        'creator_id'=>$creator_id,
                        'pay_date'=>$salary_start_date);
                }
                   if(03==$working_start_date[1] || 03==$salary_starting_month)
               {
                      $latestDate =  $this->getLatestDate($value[0]['member_id']);
                      
                      $ayear= date("Y", strtotime($latestDate['salary_start_date']))+1;
                      $bdg_startyear = $ayear.'-04-01';
                      $byear= date("Y", strtotime($latestDate['salary_end_date']))+1;
                      $bdg_endyear=$byear.'-03-31';
                      //echo $bdg_startyear.' '.$bdg_endyear;
                      $this->EditSalarymaster($value[0]['member_id'],$bdg_startyear,$bdg_endyear);

               }
            }
//            print_r($final_result);
//            exit;
            //print_r($deduce_amount);exit;
        } catch (Exception $exc) {
            echo $exc;
        }
        return $final_result;
    }
    
    public function EditSalarymaster($member_id,$bdg_startyear,$bdg_endyear) {
         try {
            //$this->db = $this->getDI()->getShared("db");
            $sql = "update salary_master set salary_start_date='".$bdg_startyear."', salary_end_date='".$bdg_endyear."' where member_id='".$member_id."'";
            //echo $sql;exit;
            $this->db->query($sql);
            
        } catch (Exception $e) {
            echo $e;
        }
        
    }
    /**
     * get latest date of salary master
     * @param type $member_id
     * @return type
     */
    public function getLatestDate($member_id) {
         try {
            //$this->db = $this->getDI()->getShared("db");
            $sql = "select salary_start_date,salary_end_date from salary_master "
                    . "where member_id='".$member_id."' order by updated_dt limit 1";
            //echo $sql;exit;
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }
    /**
     * get detail amount for the whole year (Budget end year)
     * @param type $member_id
     * @return type
     */
    public function getsalarydetail_oneyear($budget_startyear,$budget_endyear,$member_id) {
        try {
            //$this->db = $this->getDI()->getShared("db");
            $sql = "select SUM(basic_salary) as total_bsalary,SUM(overtime) as total_overtime, SUM(allowance_amount)as total_allowance,SUM(ssc_emp) as total_ssc_emp,"
                    . "SUM(absent_dedution) as total_absent_dedution, SUM(income_tax)as total_income_tax from salary_detail where (DATE(pay_date) BETWEEN '".$budget_startyear."' AND '".$budget_endyear."') AND deleted_flag=0 and member_id='".$member_id."'";
            //echo $sql;exit;
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * calculate the absent amount
     * @param type $countabsent
     * @param type $max_leavedays
     * @param type $fine
     * @param type $basic_salary
     * @return int
     */
    public function CalculateLeave($countabsent,$max_leavedays,$fine,$basic_salary) {
        if($countabsent>$max_leavedays){
        if($fine!=0)
        {
        $salary_per_day=  $basic_salary*$fine/100;
        $absent_deduce=$salary_per_day*($countabsent-$max_leavedays);
                      
        }
        else{
//        $salary_per_day=$basic_salary/22;
//        $absent_deduce=$salary_per_day*$countabsent;
        $absent_deduce=$basic_salary*(22-($countabsent-$max_leavedays))/22;
                    
            }
        }
        else{
        $absent_deduce=0;
        }
        return $absent_deduce;
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
    function checkAbsent($member_id,$budget_startyear,$budget_endyear_one) {
        try{
            $absent_deduce="";
            
            $sql = "select count(status) as countAbsent from attendances where member_id='" . $member_id . "' "
                    . "and att_date>='".$budget_startyear."' and att_date<='".$budget_endyear_one."' and deleted_flag=0 and status=2";
            //echo $sql;
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        }
        catch (Exception $ex){
            echo $ex;
        }
        return $row;
    }
    
    
    /**
     * change the status for next year
     * @param type $member_id
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function change_status($member_id) {
        try {
                $sql = "Update salary_master SET status =1 where member_id='".$member_id."'";
                
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
     * Get the latest basic salary from last year
     * @param type $member_id
     * @return type
     */
    public function getlatestOTPay($member_id,$budget_startyear, $budget_endyear) {
        try {
            $this->db = $this->getDI()->getShared("db");
            $sql = "select * from salary_detail where member_id='" . $member_id . "' and deleted_flag=0 and pay_date BETWEEN '".$budget_startyear."' AND '".$budget_endyear."' AND overtime <>0";
            //echo $sql;
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
        
        $salary_year = $diff_date+1;
        return $salary_year;
    }

    public function date_difference_new($date_difference, $budget_endyear) {
        $datetime1 = date_create($date_difference);
        $datetime2 = date_create($budget_endyear);
        $interval = date_diff($datetime1, $datetime2);
        $diff_date = $interval->format('%m');
        
        $salary_year = $diff_date;
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
    public function getAllowances($member_id,$basic_salary_annual,$date_diff,$old_allowance,$status,$all_amount,$count_pay) {
        try {
            
            $sql = "select *,SUM(allowance_amount) as total_allowance_amount from allowances where allowance_id in (
select allowance_id from salary_master_allowance where member_id='" . $member_id . "')";
            
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
            $allowance_master=$row['total_allowance_amount'];
            
            if(isset($allowance_master) || $allowance_master!=0)
            {
                
                $new_allowance=$allowance_master*$date_diff;
                $total_allowance=$new_allowance+$old_allowance;
                //$total_allowance=($row['total_allowance_amount']+$old_allowance)*$date_diff;
                echo "NEW all  ".$new_allowance;
                $basic_salary_annual=$basic_salary_annual+$total_allowance;
                echo 'Basic salary annual with allowance '.$basic_salary_annual;
            }
            else {
                $allowance_master=0;
                $new_allowance=$all_amount*$date_diff;
                $total_allowance=$new_allowance+($old_allowance*$count_pay);
                $basic_salary_annual=$basic_salary_annual+$total_allowance;
                echo 'Basic salary annual with allowance two '.$basic_salary_annual. 'Old '.$old_allowance*$count_pay;
            }
            $data['basic_salary_annual']=$basic_salary_annual;
            $data['allowance']=$allowance_master;
        } catch (Exception $e) {
            echo $e;
        }
        return $data;
    }

    //Check basic salary By member
    public function checkBasicsalaryBymember_id($tbl, $member_id, $budget_startyear, $budget_endyear) {
        try {

            $sql = "select *,SUM(basic_salary) as total_basic_salary,SUM((case when (allowance_amount) then allowance_amount else 0 end)) as total_all_amount"
                    . ", SUM((case when (overtime) then overtime else 0 end)) as total_overtime, COUNT(pay_date) as count_pay from " . $tbl . " where (DATE(pay_date) BETWEEN '".$budget_startyear."' AND '".$budget_endyear."') and member_id='" . $member_id . 
                    "' order by created_dt desc limit 1";
           //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
           
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

            $sql = "select  SUM((case when (CMT.no_of_children) then CMT.no_of_children*TD.amount else TD.amount end))as Totalamount, TD.*,CMT.* from salary_taxs_deduction as TD join salary_member_tax_deduce as CMT on TD.deduce_id=CMT.deduce_id where CMT.deduce_id in (select deduce_id from salary_member_tax_deduce CMTD where CMTD.member_id='" . $member_id . "')and CMT.member_id='" . $member_id . "'";
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
            $sql = "select * from salary_taxs where taxs_from<" . $income_tax . " and taxs_rate !=0";
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
                //echo "nnn".$todeduce;
                $Result = ($income_tax - $todeduce) * ($taxs_rate[1] / 100);
            }
        }
       
        $latest_result = round($Result / $salary_year);
        echo 'Year difference '.$salary_year.' ////';
        if($Result=="")
        {$Result=0;}
        $result['total_tax_annual']=$Result;
        $result['tax_result']=$latest_result;
        return $result;
    }
    /**
     * Calculate overtime for annual
     * @param type $member_id
     * @param type $old_overtime
     * @param type $salary_starting_date
     * @param type $budget_endyear
     * @param type $date_diff
     * @return type
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function calculate_overtime_annual($member_id,$old_overtime,$salary_starting_date,$budget_endyear,$date_diff,$totalpay_count,$ot) {
        try {
            $overtime_fees='';
            $dating=  explode('-', $salary_starting_date);
            $year=$dating[0];
            $month=$dating[1];
            $sql = "select *,SUM((case when (ATT.overtime!=0) then ATT.overtime*SM.over_time else 0 end)) as overtime_rate from salary_master as SM join attendances as Att on Att.member_id=SM.member_id"
                    . " where YEAR(ATT.att_date)='".$year."' and MONTH(ATT.att_date)='".$month."' and ATT.member_id='".$member_id."' group by ATT .member_id";
            //$sql = "select taxs_to,taxs_from,taxs_rate from taxs where taxs_rate !=0";
            //echo $sql;//exit;
            $result = $this->db->query($sql);
            $rows = $result->fetcharray();
            $ot_fees=$rows['overtime_rate'];
            echo $date_diff;
            if($ot_fees != 0)
                {
                   $overtime=$ot_fees*$date_diff; 
                   $overtime_fees=$overtime+$old_overtime;
                   echo ">>>>>".$old_overtime;
                }
            else{
                    $ot_fees=0;
                    //$overtime=$ot*$date_diff; 
                    //$overtime_fees=$overtime+$old_overtime;
                    $overtime_fees=$old_overtime;
                    echo "testing".$old_overtime.'//////////ß'.$date_diff;
                }
                $otresult['overtime']=$ot_fees;
                $otresult['overtime_annual']=$overtime_fees;
               // print_r($otresult);
        } catch (Exception $exc) {
            echo $exc;
        }
       
        return $otresult;
    }
    /**
     * Calaculate for employee
     * @return type
     */
//    public function calculate_overtime($member_id,$salary_starting_date) {
//        try {
//            $dating=  explode('-', $salary_starting_date);
//            $year=$dating[0];
//            $month=$dating[1];
//            $sql = "select ATT .member_id,SUM((case when (ATT.overtime!=0) then ATT.overtime*SA.over_time else 0 end)) as overtime_rate,
//                SA.basic_salary,SA.travel_fee from attendances  as ATT join salary_master as SA 
//                on ATT.member_id=SA.member_id where ATT .member_id
//in (select member_id from salary_master where member_id='".$member_id."') and YEAR(ATT.att_date)='".$year."' and "
//                    . "MONTH(ATT.att_date)='".$month."' group by ATT .member_id";
//            //$sql = "select taxs_to,taxs_from,taxs_rate from taxs where taxs_rate !=0";
//            //echo $sql;exit;
//            $result = $this->db->query($sql);
//            $rows = $result->fetcharray();
//            
//        } catch (Exception $exc) {
//            echo $exc;
//        }
//        return $rows;
//    }

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
            $sql = "select * from salary_master LEFT JOIN core_member ON salary_master.member_id=core_member.member_id WHERE salary_master.member_id ='".$member_id."'";
            
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }
    
    /**
     *
     *  type get $member_id
     */
    public function memidsalary($uname) {
        
            //$sql = "select salary_master.member_id from salary_master LEFT JOIN core_member ON salary_master.member_id=core_member.member_id WHERE core_member.full_name ='".$uname."'";
            $sql = "select * from core_member WHERE full_name ='".$uname."'";
            //print_r($sql);exit;
            $result = $this->db->query($sql);
            $row = $result->fetchall();
           //print_r($row);exit;
        
        return $row;
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @return $res[]?true :false
     * Salary Edit action
     */
    public function btnedit($data) {
       if($data['radio']==1){
           $travel= "travel_fee_perday";
           $empty="travel_fee_permonth";
       }
       else{
           $travel="travel_fee_permonth";
           $empty="travel_fee_perday";
       }
        $res = array();
        $res['baseerr'] = filter_var($data['basesalary'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^([\d])/'))) ? true : false;

        //$res['travelerr'] = filter_var($data['travelfee'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^([\d])/'))) ? true : false;

        $res['overtimerr'] = preg_match('/^(?=.*\d)[0-9]*$/', $data['overtime']) ? true : false;      //validate empty field and not number
        //if not valid return false
        $res['sscemp'] = preg_match('/^(?=.*\d)[0-9]*$/', $data['ssc_emp']) ? true : false;

        $res['ssccomp'] = preg_match('/^(?=.*\d)[0-9]*$/', $data['ssc_comp']) ? true : false;
       
        if ($res['baseerr'] &&  $res['overtimerr'] && $res['sscemp'] && $res['ssccomp']) {
            try {
                $sql = "Update salary_master SET basic_salary ='" . $data['basesalary'] . 
                        "', $travel ='" . $data['travelfee'] . "',$empty = 0,over_time ='" . $data['overtime'] . 
                        "',ssc_emp ='" . $data['ssc_emp'] . "',ssc_comp ='" . $data['ssc_comp'] . 
                        "',updated_dt=NOW(), salary_start_date ='".$data['start_date']."' Where id='" . $data['id'] . "'";
               
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
    /**
     * Update salary detail after calculating
     * @param type $bsalary
     * @param type $overtimerate
     * @param type $member_id
     */
    public function updatesalarydetail($bsalary,$overtimerate,$member_id,$overtime_hr) {
        try {
                $sql = "Update salary_master SET basic_salary ='" . $bsalary . "',over_time ='" . $overtimerate  . "',updated_dt=NOW() Where member_id='" . $member_id . "'";
                //echo $sql;
                $this->db->query($sql);
                $sqlupdate = "Update attendances SET overtime ='" . $overtime_hr . "' Where member_id='" . $member_id . "'";
                //echo $sql;
                $this->db->query($sqlupdate);
                //$res['valid'] = true;
//                $salarybymember_id=$this->getbsalarybyMember_id($member_id);
//                $latersalarydetail=  $this->getOldSalarydetail($member_id);
//                print_r($salarybymember_id['member_id'] );exit;
            } catch (Exception $ex) {
                echo $ex;
            }
    }
    
    public function deleteSalaryInfo($member_id) {
        try {
        $sql_salarymaster="DELETE FROM salary_master  WHERE member_id='".$member_id."'";
        $this->db->query($sql_salarymaster);
        $sql_salaryallowance="DELETE FROM salary_master_allowance WHERE member_id='".$member_id."'";
        $this->db->query($sql_salaryallowance);
        $sql_salaryallowance="DELETE FROM salary_member_tax_deduce WHERE member_id='".$member_id."'";
        $this->db->query($sql_salaryallowance);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $row;
        }
}
