<?php

namespace salts\Salary\Models;

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use salts\Salary\Models\SalaryDetail;
use Phalcon\Filter;

class SalaryDetail extends Model {
    public $base;
    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
        $this->base = new \Library\Core\Models\Base();
    }

    /**
     * Get salary list for every month
     * @return type
     * @author zinmon
     */
    public function getEachmonthsalary($currentPage) {
        try{
        $query = "SELECT  MONTH(pay_date) AS Mt,YEAR(pay_date) As Yr, (SUM(basic_salary)+SUM(travel_fee)+SUM(allowance_amount)+SUM(income_tax)+SUM(ssc_comp)+SUM(ssc_emp)) AS Total,"
                . "SUM(basic_salary) AS salary_total,(SUM(income_tax)+SUM(ssc_comp)+SUM(ssc_emp)) AS Tax_total,"
                . "SUM(ssc_emp) as ssc_emp_amount,SUM(ssc_comp) as ssc_comp_amount,"
                . "SUM(income_tax) as income_tax_amount,SUM(allowance_amount) as allowance,"
                . "SUM(travel_fee) as travel_expense  "
                . " FROM salts\Salary\Models\SalaryDetail"
                . " group by YEAR(pay_date),MONTH(pay_date)"
                . " order by pay_date desc";
        $row = $this->modelsManager->executeQuery($query);
          $paginator = new PaginatorModel(
                            array(
                        "data" => $row,
                        "limit" => 10,
                        "page" => $currentPage
                            )
                         );

// Get the paginated results
        $page = $paginator->getPaginate();        
        }  catch (Phalcon\Exception $e) {           
              $di->getShared('logger')->error($e->getMessage());
        }
        return $page;
    }

    /**
     * Get company start date
     * @return type
     */
    public function getCompStartdate() {
        try {
            $now = new \DateTime('now');
            $month = $now->format('m');
            $year = $now->format('Y');

            //$sql = "select pay_date,member_id from salary_detail";
            $sql = "select created_dt,member_id from core_member";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            //exit;
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }

    /**
     * Get salarylist
     * @return type
     * @author zinmon
     */
    public function salarylist($month, $year) {
        try {
            $sql = "select *,(SUM(`basic_salary`)+SUM(`travel_fee`)+SUM(`overtime`)+SUM(`allowance_amount`))-(SUM(`ssc_emp`)+SUM(`absent_dedution`)+SUM(`income_tax`)) AS total 
                from core_member as CM join salary_detail as SD on CM.member_id=SD.member_id where CM.member_id in (
select member_id from salary_detail) and MONTH(SD.pay_date)='" . $month . "' and YEAR(SD.pay_date)='" . $year . "' GROUP BY id";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            //exit;
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }

    /**
     * insert salary detail and overtime to salary_detail
     * @param type $row
     */
    public function insert_salarydetail($row,$pay_start_date) {
        try {

            $filter = new Filter();

            foreach ($row as $rows) {
                $basic_salary = $filter->sanitize($rows['basic_salary'], "int");
                $travel_fee = $filter->sanitize($rows['travel_fee'], "int");
                $overtime_rate = $filter->sanitize($rows['overtime_rate'], "int");
                if($overtime_rate==""){
                    $overtime_rate=0;
                }
                //$sql = "INSERT INTO salary_detail (id,member_id,basic_salary,travel_fee,overtime,pay_date) VALUES(uuid(),'" . $rows['member_id'] . "','" . $rows['basic_salary'] . "','" . $rows['travel_fee'] . "','" . $rows['overtime_rate'] . "',NOW())";
                $sql = "UPDATE salary_detail SET basic_salary ='" . $basic_salary . "', travel_fee='" . $travel_fee . "', overtime='" . $overtime_rate . "'  WHERE member_id ='" . $rows['member_id'] . "' and DATE(pay_date)='" . $pay_start_date . "'";
                //echo $sql;exit;
                $this->db->query($sql);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * Save taxs of all to salary detail
     * @param type $row
     */
    public function insertTaxs($row) {
        try {
            foreach ($row as $rows) {
                if ($rows['allowance_amount'] === "") {
                    $rows['allowance_amount'] = "0";
                }
                $sql = "INSERT INTO salary_detail (id,member_id,basic_salary,allowance_amount,absent_dedution,"
                       . "income_tax,pay_date,created_dt,basic_salary_annual,total_annual_income,basic_examption,travel_fee,overtime,creator_id) "
            . "VALUES(uuid(),'" . $rows['member_id'] . "','".$rows['basic_salary']."','" . $rows['allowance_amount'] . "','" 
                        . $rows['absent_dedution'] . "','" . $rows['income_tax'] . "','".$rows['pay_date']."',NOW(),'"
                        .$rows['basic_salary_annual']."','".$rows['total_annual_income']."','".$rows['basic_examption']."','".$rows['travel_fee']."','".$rows['overtime']."','".$rows['creator_id']."')";
                //$sql = "UPDATE salary_detail SET income_tax ='" . $rows['income_tax'] . "'  WHERE member_id ='" . $rows['member_id'] . "' and pay_date= CURDATE()";
                //echo $sql.'<br>';
                $this->db->query($sql);
            }
            //exit;
        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * insert ssc fee to salary detail
     * @param type $row
     */
    public function insertSsc($row) {
        try {
            $filter = new Filter();

            //print_r($row);exit;
            foreach ($row as $rows) {
                $ssc_comp = $filter->sanitize($rows['ssc_comp'], "int");
                $ssc_emp = $filter->sanitize($rows['ssc_emp'], "int");
                //echo "Member_id ".$rows['member_id']." "." Income tax ".$rows['income_tax'].'<br>';
                $sql = "UPDATE salary_detail SET ssc_comp ='" . $ssc_comp . "',ssc_emp='" . $ssc_emp . "'  WHERE member_id ='" . $rows['member_id'] . "' ";
                //echo $sql.'<br>';
                $this->db->query($sql);
            }
            //exit;
        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * Get salary detail for each member to print
     * @param type $member_id
     */
    public function getPayslip($member_id, $month, $year) {
        try {

            $row = $this->modelsManager->createBuilder()
                    ->columns(array('salarydet.*', 'core.*', 'salarymast.*', 'attend.*'))
                    ->from(array('salarydet' => 'salts\Salary\Models\SalaryDetail'))
                    ->join('salts\Core\Models\Db\CoreMember', 'core.member_id = salarydet.member_id', 'core')
                    ->join('salts\Salary\Models\SalaryMaster', 'salarymast.member_id = salarydet.member_id', 'salarymast')
                    ->join('salts\Core\Models\Db\Attendances', 'attend.member_id = salarymast.member_id', 'attend')
                    ->where('salarydet.member_id = :member_id:', array('member_id' => $member_id))
                    ->andWhere('MONTH(salarydet.pay_date) = :month:', array('month' => $month))
                    ->andWhere('YEAR(pay_date) = :year:', array('year' => $year))
                    //->andWhere('MONTH(attend.att_date) = :month:', array('month' => $month))
                    //->andWhere('YEAR(attend.att_date) = :year:', array('year' => $year))
                    ->limit(1)
                    ->getQuery()
                    ->execute();

        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * get allowance by member id
     * @param type $member_id
     * @return type
     */
    public function getAllowanceByMemberid($member_id) {
        try {
            $sql = "select * from allowances where allowance_id in (
select allowance_id from salary_master_allowance where member_id='" . $member_id . "')";
            //echo $sql;
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            //print_r($row);
            //exit;
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * Get salary detail for each month
     */
    public function getSalaryDetail($currentPage) {
        try {
      
            $row = $this->modelsManager->createBuilder()
                    ->columns(array('salarymas.*', 'core.*'))
                    ->from(array('salarymas' => 'salts\Salary\Models\SalaryMaster'))
                    ->leftjoin('salts\Core\Models\Db\CoreMember', 'salarymas.member_id = core.member_id', 'core')
                    ->where('salarymas.travel_fee_perday !=0')
                    ->andwhere('salarymas.deleted_flag=0')
                    ->orderby('salarymas.created_dt desc')
                    ->getQuery()
                    ->execute();
                   $paginator = new PaginatorModel(
                            array(
                        "data" => $row,
                        "limit" => 10,
                        "page" => $currentPage
                            )
                         );

// Get the paginated results
        $page = $paginator->getPaginate();        
        } catch (Exception $e) {
            echo $e;
        }
        return $page;
    }

    /**
     * 
     * @param type $member_id
     */
    public function editSalary($member_id) {
        try {
            $sql = "select * from salary_master left join core_member on "
                    . "salary_master.member_id=core_member.member_id where salary_master.id ='" . $member_id . "'";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    public function btnedit($data) {
        try {
            $filter = new Filter();
            $basic_salary = number_format($filter->sanitize($data['basesalary'], "int"));
            $travel_fee = number_format($filter->sanitize($data['travelfee'], "int"));
            $overtime = $filter->sanitize($data['overtime'], "int");
            $ssc_emp = $filter->sanitize($data['ssc_emp'], "int");
            $ssc_comp = $filter->sanitize($data['ssc_comp'], "int");

            $sql = "Update salary_master SET basic_salary ='" . $basic_salary . "',travel_fee ='" . $travel_fee . "',over_time ='" . $overtime . "',ssc_emp ='" . $ssc_emp . "',ssc_comp ='" . $ssc_comp . "' Where id='" . $data['id'] . "'";
            $this->db->query($sql);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function searchSalary($cond) {
  
        try {
           
           $select = "SELECT *, (SUM(`basic_salary`)+SUM(`travel_fee`)+SUM(`overtime`)+SUM(`allowance_amount`))-(SUM(`ssc_emp`)+SUM(`absent_dedution`)+SUM(`income_tax`)) AS total  FROM core_member JOIN salary_detail ON core_member.member_id=salary_detail.member_id ";
           $conditions = $this->setCondition($cond);
            $sql = $select;
            if (count($conditions) > 0) {
              $sql .= " WHERE " . implode(' AND ', $conditions) . " and MONTH(pay_date)='" . $cond["mth"] . "' and YEAR(pay_date)='" . $cond["yr"] . "' group by core_member.member_id";
            }
            else{
              $sql .= " WHERE   MONTH(pay_date)='" . $cond["mth"] . "' and YEAR(pay_date)='" . $cond["yr"] . "' group by core_member.member_id";

            }
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }

    public function setCondition($cond) {
      
        $salary = explode('~', $cond['salary']);

        $conditions = array();

         if ($cond['mem'] != "") {
            $conditions[] = "core_member.member_id ='" . $cond['mem'] . "'";  
        }
        if ($cond['dept'] != "") {
            $conditions[] = "member_dept_name='" . $cond['dept'] . "'";
        }
        if ($cond['position'] != "") {
            $conditions[] = "position='" . $cond['position'] . "'";
        }
        if ($cond['salary'] != "") {
            if ($salary[1] != "") {
                $conditions[] = "basic_salary>='" . $salary[0] . "' and basic_salary<='" . $salary[1] . "'";
            } else {
                $conditions[] = "basic_salary>='" . $salary[0] . "'";
            }
        }
        return $conditions;
    }

    public function updateSalarydetail($bsalary,$allowancetoadd, $member_id,$salary_start_year,
        $salary_start_month,$absent_amount,$overtime_hr,$overtimerate,$workingstartdt) {
        $Salarymaster = new SalaryMaster();
        $SM = $Salarymaster->getTodaysalaryMaster($member_id);
        //print_r($SM);
        $deduce_amount = array();
//        $now = new \DateTime('now');
//        //$budget_startmonth = '04';
//        $budget_startyear = $now->format('Y') . '-04-01';
//        //$budget_endmonth = '03';
//        $endyear = $now->format('Y') . '-03';
//        $budget_endyear = date("Y-m", strtotime("+1 year", strtotime($endyear)));
//        $budget_endyear_one = date("Y-m-d", strtotime("+1 year", strtotime($endyear)));
        $budget_endyear =  date("Y-m-d", strtotime("-1 month", strtotime($SM['salary_start_date'])));
        $budget_start_year = date("Y-m-d", strtotime("-1 year", strtotime($SM['salary_start_date'])));
        $salary = "";
        $salary_star_date = $salary_start_year.'-'.$salary_start_month;
        
        $salary_update_yr = $salary_start_year;
        $salary_update_mth = $salary_start_month;
        $resign=  $this->getResigndate($member_id);
        $basic_salary='';
        $SD = $this->getoldsalarydetail($member_id, $salary_update_yr, $workingstartdt,$budget_endyear);
        //print_r($SD);
        if($resign['resign_date']!=null){
            $resigndate=  explode("-", $resign['resign_date']);
            $resignyear=$resigndate[1];
            $resignmonth=$resigndate[0];
            $bsalaryparday=$SM['basic_salary']/24;
            $count_attdate=$this->countattdate($resign['resign_date'],$resignmonth,$member_id);
            //print_r($count_attdate);
            $salary=$count_attdate['count_attdate']*$bsalaryparday;
            //echo "SALARY".$bsalaryparday;
            $count_paymonth=  $this->getPaySalarymonth($resignyear,$resignmonth,$member_id);
            $year=$count_paymonth['count_pay_date'];
            
        }
        else{
            
            $date_diff=$Salarymaster->dateDifference($salary_star_date, $budget_endyear);
            
            $basic_salary=$bsalary*$date_diff;
            if(!empty($SD))
                {
                    $basic_salary=$SD['total_salary'];
                    $old_allowance=$SD['total_all_amount']+$allowancetoadd;
                    $date_to_calculate=$SD['count_pay'];
                }
            $Allowanceresult = $Salarymaster->getAllowances($SM['member_id'],$basic_salary,$date_diff,$allowancetoadd,$SM['status'],$SD['total_all_amount'],$SD['count_pay']);
            $basic_salary=$Allowanceresult['basic_salary_annual'];
           
            $latest_otpay = $Salarymaster->getlatestOTPay($member_id, $budget_start_year, $budget_endyear);
            $OTResult = $Salarymaster->calculateOvertimeAnnual($member_id, $SD['total_overtime'], $budget_start_year, $budget_endyear, $date_diff, $SD['count_pay'], $latest_otpay['overtime']);
            //print_r($OTResult);
            
            $ot_fees=($overtimerate*$overtime_hr)+$OTResult['overtime_annual'];
            $basic_salary = $basic_salary+$ot_fees;
            //check the user who is absent.
            $absent=  $Salarymaster->checkAbsent($member_id,$SM['salary_start_date'],$budget_endyear);
            
            //Get the data of leave setting
            $leavesetting=  $Salarymaster->getleavesetting();
            //calculate absent deduce
            $countabsent=$Salarymaster->calculateLeave($absent['countAbsent'], $leavesetting['max_leavedays'], $leavesetting['fine_amount'], $SM['basic_salary']);
            $absent_dedution=$countabsent+$absent_amount;
            $basic_salary = $basic_salary-$absent_dedution;
            
            $basic_deduction = $basic_salary * (20 / 100);
                    //echo "SALARY ".$basic_deduction;
                    
                    //calculate ssc pay amount to deduce
                    if ($SM['basic_salary'] > 300000) {
                        
                        $emp_ssc = (300000 * $date_to_calculate) * (2 / 100);
                    } else {
                        
                        $emp_ssc = ($SM['basic_salary'] * $date_to_calculate) * (2 / 100);
                    }

                    $deduce_amount = $Salarymaster->getreduce($SM['member_id']);
                    //print_r($deduce_amount).'<br>';
                    
                    $total_deduce = $deduce_amount[0]['Totalamount'] + $basic_deduction + $emp_ssc;
                    
                    //taxable income (total_basic-total deduce)
                    $income_tax = $basic_salary - $total_deduce;
                    if(3 == $salary_start_month){
                    $date_to_calculate=1;
                    }
                    $taxs = $Salarymaster->deducerate($income_tax, $date_to_calculate);
                    $TaxResult = $taxs['tax_result'];
                    if(3 == $salary_start_month){
                    $oldResult = $this->getoldsalarydetailByMember_id($member_id, $budget_start_year, $workingstartdt,$budget_endyear);
                    //print_r($oldResult);
                    $TaxResult = $taxs['tax_result']-$oldResult['incometax'];
                    }
        }
        
        $final_result[] = array('income_tax' => $TaxResult,
            'member_id' => $member_id, 'allowance_amount' => $Allowanceresult['allowance'],
            'special_allowance' => $allowancetoadd,'overtime' => $ot_fees,
            'absent_dedution' => $absent_dedution,'basic_salary' => $SM['basic_salary']);
       //print_r($final_result);exit;
       $Result=$this->saveSalaryEditdata($final_result,$salary_start_year,$salary_start_month);
       
      
        return $Result;
    }
    /**
     * Save salary edit data
     * @param type $param
     * @param type $salary_start_year
     * @param type $salary_start_month
     * @return string
     */
    public function saveSalaryEditdata($param,$salary_start_year,$salary_start_month) {
        try {
            
            $filter = new Filter();
            foreach ($param as $params) {
            $basic_salary = $filter->sanitize($param[0]['basic_salary'], "int");
            $member_id = $filter->sanitize($param[0]['member_id'], "string");
            $allowance_amount = $filter->sanitize($param[0]['allowance_amount'], "int");
            $special_allowance_amount = $filter->sanitize($param[0]['special_allowance'], "int");
            $otFees = $filter->sanitize($param[0]['overtime'], "int");
            $income_tax = $filter->sanitize($param[0]['income_tax'], "int");
            $absent_deduction = $filter->sanitize($param[0]['absent_dedution'], "int");
            $sql = "UPDATE salary_detail SET basic_salary ='" . $basic_salary . "', allowance_amount='" . $allowance_amount . "', income_tax='" . $income_tax . "', absent_dedution='".$absent_deduction."',"
                    . "special_allowance='".$special_allowance_amount."', overtime ='".$otFees."' WHERE member_id ='" . $member_id . "' and YEAR(pay_date)='" . $salary_start_year . "' and MONTH(pay_date)='".$salary_start_month."'";
            //echo $sql;exit;
            //$this->db->query($sql);
            if($this->db->query($sql)){
            $result="pass";  
            }
             else {
            $result="fail";
            }
            }
            
        } catch (Exception $ex) {
            echo $ex;
        }
        //print_r($row);exit;
        return $result;
    }
    public function getPaySalarymonth($resignmonth,$resignyear,$member_id) {
       
        try {
            $sql = "select count(pay_date) as count_pay_date from salary_detail where member_id='" . $member_id . "' and MONTH(pay_date)='" . $resignmonth . "' and YEAR(pay_date)<='".$resignyear."'";
            //echo $sql;exit;
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }
    
    public function getResigndate($member_id) {
        try {
            $sql = "select resign_date from salary_detail where member_id='" . $member_id . "'";
            //echo $sql.'<br>';exit;
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }
    /**
     * 
     * @param type $resigndate
     * @param type $resignyear
     * @param type $resignmonth
     * @param type $member_id
     * @return type
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function countattdate($resigndate,$resignmonth,$member_id) {
        try {
            $sql = "select count(att_date) as count_attdate from attendances where member_id='" . $member_id . "' and DATE(att_date)<='" . $resigndate . "'";
            //echo $sql.'<br>';exit;
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }

    public function getoldsalary($budget_startmonth,$member_id, $salary_update_yr, $salary_update_mth) {
        try {
            
            $salary_update_mth =$salary_update_mth-1;
            $sql = "select SUM(basic_salary) as total_salary,COUNT(pay_date)as count_pay from salary_detail where member_id='" . $member_id . "' and MONTH(pay_date)<='" . $salary_update_mth . "' and YEAR(pay_date)='" . $salary_update_yr . "' and MONTH(pay_date)>='".$budget_startmonth."'";

            //echo $sql.'<br>';exit;
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }
    
    public function getoldsalarydetail($member_id, $salary_update_yr, $workingstartdt,$budget_endyear) {
        try {
            $sql = "select SUM((case when (basic_salary) then basic_salary else 0 end))as total_salary,COUNT(pay_date)as count_pay, SUM(allowance_amount) as total_all_amount,"
                    . "SUM((case when (overtime) then overtime else 0 end)) as total_overtime from salary_detail "
                    . "where member_id='" . $member_id . "' and YEAR(pay_date)<='" . $salary_update_yr . "' and pay_date>='".$workingstartdt."'";
//            $sql = "select *,SUM(basic_salary) as total_basic_salary,SUM((case when (allowance_amount) then allowance_amount else 0 end)) as total_all_amount"
//                    . ", SUM((case when (overtime) then overtime else 0 end)) as total_overtime, COUNT(pay_date) as count_pay from " . $tbl . " where (DATE(pay_date) BETWEEN '".$budget_startyear."' AND '".$budget_endyear."') and member_id='" . $member_id . 
//                    "' order by created_dt desc limit 1";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }
    public function getoldsalarydetailByMember_id($member_id, $budget_start_year, $workingstartdt,$budget_endyear) {
        try {
            $sql = "select SUM((case when (basic_salary) then basic_salary else 0 end))as total_salary,COUNT(pay_date)as count_pay, SUM(allowance_amount) as total_all_amount,"
                    . "SUM((case when (overtime) then overtime else 0 end)) as total_overtime, SUM((case when (income_tax) then income_tax else 0 end))as incometax from salary_detail "
                    . "where member_id='" . $member_id . "' and YEAR(pay_date)>='" . $budget_start_year . "' and pay_date<='".$budget_endyear."'";
//            $sql = "select *,SUM(basic_salary) as total_basic_salary,SUM((case when (allowance_amount) then allowance_amount else 0 end)) as total_all_amount"
//                    . ", SUM((case when (overtime) then overtime else 0 end)) as total_overtime, COUNT(pay_date) as count_pay from " . $tbl . " where (DATE(pay_date) BETWEEN '".$budget_startyear."' AND '".$budget_endyear."') and member_id='" . $member_id . 
//                    "' order by created_dt desc limit 1";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }
    public function addResign($data){
          try{
         $sql = "Update salary_detail SET resign_date ='". $data['resign_date'] ."' Where member_id='".$data['member_id']."'";
         $this->db->query($sql);
     } catch (Exception $ex) {
         echo $ex;
     }
    }
     /**
     * Saw Zin Min Tun     
     */
    public function findMonthyear($monthyear) {       
     //  print_r($monthyear);exit;
        //exit;
        // Check if the user exist
        $monthyear = $monthyear;
       // print_r($monthyear);exit;
        $this->db = $this->getDI()->getShared("db");
        $query = "SELECT * FROM salary_detail where month(pay_date) =month(' ".$monthyear ." ')  and year(pay_date) =year(' ".$monthyear ." ')  and deleted_flag=0";
       // print_r($query);exit;
        $user = $this->db->query($query);
        $user = $user->fetchAll(); 
      
        return $user;

    }
    
    public function searchSList($param,$currentPage) {
        try{
            if($param['travel_fees'] == 1){
            $field="travel_fee_perday";
            }
            if($param['travel_fees'] == 2){
            $field="travel_fee_permonth";
            }
            $select = "SELECT sm.member_id,c.member_login_name,sm.basic_salary,sm.".$field.",sm.over_time,sm.ssc_emp,sm.ssc_comp FROM salts\Core\Models\Db\SalaryMaster as sm"
                    . " join salts\Core\Models\Db\CoreMember as c on sm.member_id= c.member_id";
            $select .= " WHERE sm.".$field." <> 0";
            if($param['user_id'] !== ""){
                $select .= " and sm.member_id='" . $param["user_id"] . "'";
            }            
            $select .= " ORDER BY sm.created_dt desc";
            //echo $select;exit;
            $result = $this->modelsManager->executeQuery($select);
            $page = $this->base->pagination($result, $currentPage);
        } catch (Exception $ex) {
         echo $ex;
        }
        return $page;
    }
    /**
     * @author David JP <david.gnext@gmail.com>
     * @since 1/27/2016
     * @desc Salary Detail calculate by csv 
     */
    public function getSalaryDetailField(){
         $query = "show columns from salary_detail";
         $data = $this->db->query($query);
         $rows = $data->fetchall();    
         return $rows;
    }
    
    /**
     * Header for csv file
     * @param type $param
     * @return string
     * @author David
     */
    public function getHeader($param) {
        $n = 0;$header = array();
        $getField = ["member_id"=>0,"basic_salary"=>1,"basic_salary_annual"=>2,"travel_fee"=>3,
            "overtime"=>4,"allowance_amount"=>5,"ssc_comp"=>6,"ssc_emp"=>7,"absent_dedution"=>8,
            "income_tax"=>9,"total_annual_income"=>10,"basic_examption"=>11,"pay_date"=>12];
        foreach ($param as $v){
            if(array_key_exists($v['Field'],$getField)){
                    if($n === 0){
                            $header[] = strtoupper($v["Field"])."(X)";
                        }
                        else if($n === 1){
                            $header[] = "MEMBER_NAME(X)";
                            $header[] = "FULL_NAME(X)";
                            $header[] = strtoupper($v["Field"])."(INT)";
                        }                        
                        else if($n === 12){
                            $header[] = strtoupper($v["Field"])."(Y-M-D)";
                        }
                        else{
                            $header[] = strtoupper($v["Field"])."(INT)";
                        }                        
                         $n++;
                    }                   
            }
            return $header;
    }
    
    /**
     * Import csv file
     * @param type $data
     * @return string
     * @author David
     */
    public function importSalary($data){
        try {        
        $salDetail = new SalaryDetail();
        $filter = new Filter();
        $da    = array();
        $return = array();
        $da["id"] = uniqid();
        $da['member_id'] = $filter->sanitize(isset($data[0]) ? $data[0] : "", "string");
        $da['basic_salary'] = $filter->sanitize(isset($data[3]) ? $data[3] : "", "int");
        $da["basic_salary_annual"] = $filter->sanitize(isset($data[4])?$data[4]:"","int");
        $da["travel_fee"] = $filter->sanitize(isset($data[5]) ? $data[5] : "", "int");
        $da["overtime"] = $filter->sanitize(isset($data[6]) ? $data[6] : "", "int");
        $da["allowance_amount"] = $filter->sanitize(isset($data[7]) ? $data[7] : "", "int");
        $da["ssc_comp"] = $filter->sanitize(isset($data[8]) ? $data[8] : "", "int");
        $da["ssc_emp"] = $filter->sanitize(isset($data[9]) ? $data[9] : "", "int");
        $da["absent_dedution"] = $filter->sanitize(isset($data[10]) ? $data[10] : "", "int");
        $da["income_tax"] = $filter->sanitize(isset($data[11]) ? $data[11] : "", "int");
        $da["total_annual_income"] = $filter->sanitize(isset($data[12]) ? $data[12] : "", "int");
        $da["basic_examption"] = $filter->sanitize(isset($data[13]) ? $data[13] : "", "int");
        $paydate = isset($data[14]) ? $data[14] : 0;
        (0 !== $paydate) ? $da['pay_date'] = date("Y-m-d",strtotime($paydate)) : $da['pay_date'] = null;
        $da["creator_id"] = $data["member_id"];
        $da['updated_dt'] = date("Y-m-d H:m:s");
        $da['created_dt'] = date("Y-m-d H:m:s");
             if ($salDetail->save($da) == false) {
                foreach ($salDetail->getMessages() as $message) {
                    $return[] = $message;
                }
            } else {
                $return [0] = "Data was saved successfully!";
            }
            return $return;
        }
        catch (Exception $e) {
            echo $e;
        }
  }
       /**
     * Saw Zin Min Tun     
     */
    public function addMemberid($member_id,$paydate) {    
        $this->db = $this->getDI()->getShared("db");
         foreach ($member_id as $result) { 
                 $query = "UPDATE salary_detail SET  print_id = 1 where member_id ='" . $result . "' and pay_date='" . $paydate . "'";
              $output =   $this->db->query($query);
        }
        return $output;       
    }
    
       /**
     * Saw Zin Min Tun     
     */
    public function colorprint() {   
        $this->db = $this->getDI()->getShared("db");
        $query = "SELECT * FROM salary_detail where print_id = 1 and deleted_flag=0";
      // print_r($query);exit;
        $user = $this->db->query($query);
        $users = $user->fetchAll(); 
        //var_dump($users);exit;
        return $users;
    }
}
