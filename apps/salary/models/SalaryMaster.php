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
    public function savesalarydedution($dedution, $no_of_children, $member_id, $creator_id) {
        try {
            
            for ($i = 0; $i < count($dedution); $i++) {

                $sql = "INSERT INTO workManagiment\Salary\Models\SalaryMemberTaxDeduce 
                        (deduce_id,member_id,creator_id, created_dt,updater_id,updated_dt,deleted_flag)
                        VALUES('" . $dedution[$i] . "','" . $member_id . "', '" 
                        . $creator_id . "',NOW(),0,'00:00:00',0)";
                $result = $this->modelsManager->executeQuery($sql);
            }
             $sql="UPDATE salary_member_tax_deduce SET"
                . " no_of_children='" . $no_of_children. "' WHERE member_id='" . $member_id. "' and deduce_id='children'";
            //echo $sql;exit;
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
    public function getbasicsalary() {
        try {
            $month=  date('m');
            $sql = "select basic_salary,status,member_id,travel_fee,salary_start_date as comp_start_date "
                    . "from salary_master where deleted_flag=0 and member_id in (select member_id from attendances where MONTH(att_date)=$month)";
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
    public function calculate_tax_salary($param,$salary_start_date) {

        try {
            //echo $salary_start_date;exit;
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
            $final_result="";
            $up_date="";
            $absent_dedution="";
            $date_diff="";
            foreach ($param as $value) {
                //get the salary start date to calculate salary
                $start_date = explode("-", $value['comp_start_date']);
                $comp_start_date=$start_date[0].'-'.$start_date[1];
                $comp_start_month = $start_date[1];
                //$w_startdt=  $this->getWorkingStartdt($value['member_id']);
                
                //get the working start date from core_member table
                $working_start_date = explode("-", $salary_start_date);
                $w_start_dt=$working_start_date[0].'-'.$working_start_date[1];
               
                if($comp_start_date!==$w_start_dt)
                {
                   
                    $comp_start_date=$w_start_dt;
                    $start_date = explode("-", $comp_start_date);
                    $comp_start_date=$start_date[0].'-'.$start_date[1];
                    
                }
                
                echo "STARTING date ".$comp_start_date.'<br>';
                //Get the basic salary from salary master
                $SM = $this->getLatestsalary($value['member_id']);
                //Get the basic salary which the latest pay in salary 
                $SD = $this->checkBasicsalaryBymember_id('salary_detail',
                        $value['member_id'], $budget_startyear, $budget_endyear);
                $latest_payday='0';
                //if data is exist in salary detail
                if(!empty($SD)){
                //echo "STARTING date ".$comp_start_date.'<br>';
                $payday=  explode("-", $SD['pay_date']);
                $latest_payday=$payday[1];
                echo 'RRRR'.$comp_start_date;
//                $update=  explode(" ", $SM['salary_start_date']);
//                $dt=  explode("-", $update[0]);
//                $up_date=$dt[0].'-'.$dt[1];
                
                $date_diff=$this->date_difference($comp_start_date, $budget_endyear);
                
                $new_salary=$SM['basic_salary']*$date_diff;
                
                //Get the old basic salary
                $countsalarydetail = $this->getCountSalarydetail(
                                $budget_startyear, $budget_endyear, $value['member_id']);
                        $old_payamount = $countsalarydetail['pay_amount'];
                $date_diff=$date_diff+$countsalarydetail['COUNT']; 
                $salary=$new_salary+$old_payamount;
                echo 'RRRR'.$salary;
                }
                
                //check the user who is absent.
                $absent=  $this->checkAbsent($value['member_id']);
                //Get the data of leave setting
                $leavesetting=  $this->getleavesetting();
                //calculate absent deduce
                $countabsent=$this->CalculateLeave($absent['countAbsent'], $leavesetting['max_leavedays'], $leavesetting['fine_amount'], $SM['basic_salary']);
                $absent_dedution=$countabsent;
                
                //check salary detail is over one year or not
                $chkStatus=$this->chkStatus($value['member_id'],$value['status'], $comp_start_month, 
                $budget_startmonth,$countabsent,$latest_payday, $budget_startyear, $comp_start_date,
                $budget_endyear, $SD, $SM['basic_salary'], $SD['basic_salary'],$budget_endmonth);
                //print_r($chkStatus);
                
                if(isset($chkStatus['date_diff']))
                {
                $date_diff=$chkStatus['date_diff'];
                $salary=$chkStatus['salary'];
                }
                
                //Get the total allowance amount
                $Allowanceresult = $this->getAllowances($value['member_id']);
                $allowance=$Allowanceresult['total_allowance_amount'];
                //Check total allowance is or not
                $chkallowance=$this->CalculateAllowance($Allowanceresult['total_allowance_amount'],$date_diff);
               
                echo "basic salary".$value['basic_salary'].'<br>'.$chkallowance.'<br>';
                
                //Get data of salary detail by member id
                $checkmember = $this->checkmember_id($value['member_id']);
                $chkSalary=$this->chkSalarybyMember_id($checkmember,$SM['basic_salary'],$SD['basic_salary'],
                $value['status'],$comp_start_date,$budget_endyear,$value['member_id'],$budget_startyear,$countabsent,
                $SD['allowance_amount'],$chkallowance);
                
                if($chkSalary['date_diff']!="")
                {
                
                $date_diff=$chkSalary['date_diff'];
                $salary=$chkSalary['salary'];
                }
                echo "Date ".$date_diff .'//';
                if ($SM['basic_salary'] === $SD['basic_salary']
                    && $SD['allowance_amount']==$chkallowance && $value['status']==0)
                  {
                   
                   $check_salary_detail = $this->getsalarydetail_check($value['member_id']);
                   
                   $final_result[] = array('basic_salary' => $value['basic_salary'],
                                    'income_tax' => $check_salary_detail['income_tax'],
                                    'total_annual_income' => $check_salary_detail['total_annual_income'],
                                    'basic_salary_annual' => $check_salary_detail['basic_salary_annual'],
                                    'basic_examption' => $check_salary_detail['basic_examption'],
                                    'member_id' => $check_salary_detail['member_id'], 
                                    'allowance_amount' => $check_salary_detail['allowance_amount'], 
                                    'absent_dedution'=>$absent_dedution,
                                    'pay_date'=>$salary_start_date);
                  }  
                else if ($SM['basic_salary'] === $SD['basic_salary'] 
                    && $SD['allowance_amount']==$chkallowance && $value['status']==1 && $latest_payday!='03')
                {
                    
                    $check_salary_detail = $this->getsalarydetail_check($value['member_id']);
                    //print_r($check_salary_detail);
                    $final_result[] = array('basic_salary' => $value['basic_salary'],
                        'income_tax' => $check_salary_detail['income_tax'],
                        'total_annual_income' => $check_salary_detail['total_annual_income'],
                        'basic_salary_annual' => $check_salary_detail['basic_salary_annual'],
                        'basic_examption' => $check_salary_detail['basic_examption'],
                        'member_id' => $check_salary_detail['member_id'], 
                        'allowance_amount' => $check_salary_detail['allowance_amount'], 
                        'absent_dedution'=>$absent_dedution,
                        'pay_date'=>$salary_start_date);
                } 
                
                else {
                    
                    //Insert new allowance to add to basic salary
                    $getsalary=$this->Addallowance($Allowanceresult,$salary,$SD['allowance_amount'],$date_diff,
                    $allowance,$up_date, $budget_endyear,$budget_startyear,$SM['basic_salary'],$value['member_id']);
                    $salary=$getsalary;
                    //print_r($getsalary);
                    //get 20% for the whole year
                    $basic_deduction = $salary * (20 / 100);
                    echo "SALARY ".$salary;
                    
                    //calculate ssc pay amount to deduce
                    if ($value['basic_salary'] > 300000) {
                        $emp_ssc = (300000 * $date_diff) * (2 / 100);
                    } else {
                        $emp_ssc = ($value['basic_salary'] * $date_diff) * (2 / 100);
                    }

                    $deduce_amount = $this->getreduce($value['member_id']);
                    //print_r($deduce_amount).'<br>';
                    
                    $total_deduce = $deduce_amount[0]['Totalamount'] + $basic_deduction + $emp_ssc;
                    echo "Total deduction is ".$deduce_amount[0]['Totalamount'];
                    
                    //taxable income (total_basic-total deduce)
                    $income_tax = $salary - $total_deduce;

                    //echo "The Income tax  is " . $income_tax . '<br>';

                    $taxs = $this->deducerate($income_tax, $date_diff);
//                    print_r($taxs);
                    $final_result[] = array('basic_salary' => $value['basic_salary'],
                        'income_tax' => $taxs['tax_result'],
                        'total_annual_income' => $taxs['total_tax_annual'],
                        'basic_salary_annual' => $salary,
                        'basic_examption' => $basic_deduction,
                        'member_id' => $value['member_id'], 
                        'allowance_amount' => $allowance, 
                        'absent_dedution'=>$absent_dedution,
                        'pay_date'=>$salary_start_date);
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

//    public function getWorkingStartdt($member_id) {
//        try {
//            $sql = "select * from core_member where member_id='" . $member_id . "' and deleted_flag=0";
//            //echo $sql;exit;
//            $result = $this->db->query($sql);
//            $row = $result->fetcharray();
//        } catch (Exception $e) {
//            echo $e;
//        }
//        return $row;
//    }
    public function Addallowance($Allowanceresult,$salary,$detailallowance,$date_diff,$allowance,
            $up_date, $budget_endyear,$budget_startyear,$salarymaster,$member_id) {
        //Insert new allowance to add to basic salary
                
                if (!empty($Allowanceresult)) {
                    if(empty($detailallowance) && isset($Allowanceresult['total_allowance_amount'])){
                    $allowance=$Allowanceresult['total_allowance_amount'];
                    $salary+=$allowance;
                //echo "ALLOWANCE";
                    }
                    else if($detailallowance!=$allowance)
                    {
                    $date_diff = $this->date_difference($up_date, $budget_endyear);
                        $newsalary_rate = $salarymaster * $date_diff;
                        
                        $countsalarydetail = $this->getCountSalarydetail(
                                $budget_startyear, $budget_endyear, $member_id);
                        $old_payamount = $countsalarydetail['pay_amount'];
                        $date_diff+=$countsalarydetail['COUNT'];
                        $salaryone = $newsalary_rate + $old_payamount;
                        $salary=$allowance+$salaryone;
                        //echo $old_payamount.'///';

                   
                    }
                    else {
                        
                        $salary=$allowance+$salary;
                        echo $salary."Eain";
                    }
                }
                return $salary;
    }
    /**
     * Check salary by memberid
     * @param type $checkmember
     * @param type $salarymaster
     * @param type $salarydetail
     * @param type $status
     * @param type $up_date
     * @param type $budget_endyear
     * @param type $member_id
     * @param type $budget_startyear
     * @param type $absent_deduce
     * @param type $allowance_amount
     * @param type $allowance
     * @return type
     */
    public function chkSalarybyMember_id($checkmember,$salarymaster,$salarydetail,
            $status,$up_date,$budget_endyear,$member_id,$budget_startyear,$absent_deduce,$allowance_amount,$allowance) 
    {
    
    //Check the wherether  the member is got salary or new member
    
    if (!empty($checkmember)) {
    //echo 'The member_id is in salary detail';
    if ($salarymaster != $salarydetail && $status==0) {
                        
    //If salary is increased or changed
    $date_diff = $this->date_difference($up_date, $budget_endyear);
    $newsalary_rate = $salarymaster * $date_diff;
    echo "New salary ".$up_date.'//';
    //get the sum of old salary
    $countsalarydetail = $this->getCountSalarydetail(
    $budget_startyear, $budget_endyear, $member_id);
    $old_payamount = $countsalarydetail['pay_amount'];
    $date_diff+=$countsalarydetail['COUNT'];
    $data['date_diff']=$date_diff;
    //get the year to calculate salary
    $data['salary'] = ($newsalary_rate + $old_payamount)-$absent_deduce;
    echo "M ID ".$data['salary']."Not EQUAl".$date_diff."<br><br>";
    }
    //Check the salary is changed after 1 year
    if ($salarymaster != $salarydetail && $status==1) {
    $date_diff = $this->date_difference($up_date, $budget_endyear);
    $newsalary_rate = $salarymaster * $date_diff;
    //echo "DDD".$newsalary_rate."GGG";
    $countsalarydetail = $this->getCountSalarydetail(
    $budget_startyear, $budget_endyear, $member_id);
    $old_payamount = $countsalarydetail['pay_amount'];
    $date_diff+=$countsalarydetail['COUNT'];
    $data['date_diff']=$date_diff;
    $data['salary'] = ($newsalary_rate + $old_payamount)-$absent_deduce;
    //echo "FFFFvv".$data['salary'];
    }
   }
   if(!empty($data)){
   return $data;}
    }

    /**
     * Calculate total allowance
     * @param type $total_allowance_amount
     * @return int
     */
    public function CalculateAllowance($total_allowance_amount,$date_diff) {
        if(isset($total_allowance_amount))
        {
        $allowance=$total_allowance_amount*$date_diff;
        }
        else{
        $allowance=0;
        }
        
        return $allowance;
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
        if($fine!="")
        {
        $salary_per_day=  $basic_salary*$fine/100;
        $absent_deduce=$salary_per_day*$countabsent;
                      
        }
        else{
        $salary_per_day=$basic_salary/22;
        $absent_deduce=$salary_per_day*$countabsent;
                    
            }
        }
        else{
        $absent_deduce=0;
        }
        return $absent_deduce;
    }
    /**
     * Check status after one year service
     * @param type $member_id
     * @param type $status
     * @param type $comp_start_month
     * @param type $budget_startmonth
     * @param type $absent_deduce
     * @param type $latest_payday
     * @param type $budget_startyear
     * @param type $comp_start_date
     * @param type $budget_endyear
     * @param type $SD
     * @param type $salarymaster
     * @param type $salarydetail
     * @param type $budget_endmonth
     * @return type
     */
    public function chkStatus($member_id,$status,$comp_start_month,$budget_startmonth,$absent_deduce,$latest_payday,
    $budget_startyear,$comp_start_date,$budget_endyear,$SD,$salarymaster,$salarydetail,$budget_endmonth) 
    {
    //befor one year service
    if($status==0)
    {
    //if company starting date is equal to budget start date
    if($comp_start_month==$budget_startmonth or $latest_payday==$budget_startmonth){
    $data['date_diff']=12;
    $data['salary']=($salarymaster*$data['date_diff'])-$absent_deduce;
    //echo "new year ";
    }
    
    //if company start date is between budget start date and end date
    if($comp_start_date>$budget_startyear && $comp_start_date<$budget_endyear  && empty($SD)){
    
    $data['date_diff']=$this->date_difference($comp_start_date,$budget_endyear);
    $data['salary']=($salarymaster*$data['date_diff'])-$absent_deduce;
    //echo "aaaaaaaa".$data['salary'].'<br>';
    }
    //if company start month is equal with budget end month
    if($comp_start_month==$budget_endmonth && $salarydetail==""){
    $data['salary']=$salarymaster-$absent_deduce;
    //change the status to 1 because of over 1year
    $this->change_status($member_id);
    
    }
    //if company start month is lessthen and equal budget end month
    if($comp_start_month<=$budget_endmonth)
    {
    $data['date_diff']=$this->date_difference_new($comp_start_date,$budget_startyear);
    $data['salary']=($salarymaster*$data['date_diff'])-$absent_deduce;
    //echo "HHhhhhhhhhh".$data['salary'];
    }
      
    if($latest_payday=='03')
        {
    $this->change_status($member_id);
    
        }
    }
    //After company starting one year
    if($status==1){
    $data['date_diff']=12;
    $data['salary']=($salarymaster*$data['date_diff'])-$absent_deduce;
    
    }
    //print_r($data);
    if(!empty($data)){
    return $data;
        }
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

            $sql = "select * from " . $tbl . " where member_id='" . $member_id . 
                    "' order by created_dt desc limit 1";
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
                    //echo 'Final '.$first_result."<br>";
                } else {
                    $second_result+=$taxs_rate[0] * ($taxs_rate[1] / 100);
                }
                //echo $second_result.'<br>';
            }
            $Result = $first_result + $second_result;
           // echo "Final result ".$Result.'<br>';
        } else {

            for ($i = 0; $i < count($taxsrate_data); $i++) {
                $taxs_rate = explode(" ", $taxsrate_data[$i]);
                $todeduce = $taxs_rate[0] - 1000000;
                //echo "nnn".$todeduce;
                $Result = ($income_tax - $todeduce) * ($taxs_rate[1] / 100);
            }
        }
        //echo 'Year difference '.$salary_year.' ////';

        $latest_result = round($Result / $salary_year);
        if($Result=="")
        {$Result=0;}
        $result['total_tax_annual']=$Result;
        $result['tax_result']=$latest_result;
        return $result;
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
        
        $res = array();
        $res['baseerr'] = filter_var($data['basesalary'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^([\d])/'))) ? true : false;

        $res['travelerr'] = filter_var($data['travelfee'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^([\d])/'))) ? true : false;

        $res['overtimerr'] = preg_match('/^(?=.*\d)[0-9]*$/', $data['overtime']) ? true : false;      //validate empty field and not number
        //if not valid return false
        $res['sscemp'] = preg_match('/^(?=.*\d)[0-9]*$/', $data['ssc_emp']) ? true : false;

        $res['ssccomp'] = preg_match('/^(?=.*\d)[0-9]*$/', $data['ssc_comp']) ? true : false;

        if ($res['baseerr'] && $res['travelerr'] && $res['overtimerr'] && $res['sscemp'] && $res['ssccomp']) {
            try {
                $sql = "Update salary_master SET basic_salary ='" . $data['basesalary'] . 
                        "',travel_fee ='" . $data['travelfee'] . "',over_time ='" . $data['overtime'] . 
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
    public function updatesalarydetail($bsalary,$overtimerate,$member_id) {
        try {
                $sql = "Update salary_master SET basic_salary ='" . $bsalary . "',over_time ='" . $overtimerate  . "',updated_dt=NOW() Where member_id='" . $member_id . "'";
                //echo $sql;
                $this->db->query($sql);
               // print_r($sql);exit;
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
