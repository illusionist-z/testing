<?php

namespace salts\Salary\Models;

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use salts\Salary\Models\SalaryDetail;
use salts\Core\Models\Db\CoreMember;
use Phalcon\Filter;
use salts\Core\Models\Db\Attendances;

class SalaryDetail extends Model {

    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * Get salary list for every month
     * @return type
     * @author zinmon
     */
    public function geteachmonthsalary() {
        $query = "SELECT  MONTH(pay_date) AS Mt,YEAR(pay_date) As Yr, (SUM(basic_salary)+SUM(travel_fee)+SUM(allowance_amount)+SUM(income_tax)+SUM(ssc_comp)+SUM(ssc_emp)) AS Total,"
                . "SUM(basic_salary) AS salary_total,(SUM(income_tax)+SUM(ssc_comp)+SUM(ssc_emp)) AS Tax_total,"
                . "SUM(ssc_emp) as ssc_emp_amount,SUM(ssc_comp) as ssc_comp_amount,"
                . "SUM(income_tax) as income_tax_amount,SUM(allowance_amount) as allowance,"
                . "SUM(travel_fee) as travel_expense  "
                . " FROM salts\Salary\Models\SalaryDetail"
                . " group by YEAR(pay_date),MONTH(pay_date)"
                . " order by pay_date desc";
        $row = $this->modelsManager->executeQuery($query);
        return $row;
    }

    /**
     * Get company start date
     * @return type
     */
    public function getComp_startdate() {
        try {
            $now = new \DateTime('now');
            $month = $now->format('m');
            $year = $now->format('Y');
            $sql = "select created_dt,member_id from core_member";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
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
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $row;
    }

    /**
     * insert salary detail and overtime to salary_detail
     * @param type $row
     */
    public function insert_salarydetail($row, $pay_start_date) {
        try {
            $filter = new Filter();
            foreach ($row as $rows) {
                $basic_salary = $filter->sanitize($rows['basic_salary'], "int");
                $travel_fee = $filter->sanitize($rows['travel_fee'], "int");
                $overtime_rate = $filter->sanitize($rows['overtime_rate'], "int");
                if ($overtime_rate == "") {
                    $overtime_rate = 0;
                }
                $sql = "UPDATE salary_detail SET basic_salary ='" . $basic_salary . "', travel_fee='" . $travel_fee . "', overtime='" . $overtime_rate . "'  WHERE member_id ='" . $rows['member_id'] . "' and DATE(pay_date)='" . $pay_start_date . "'";
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
    public function insert_taxs($row) {
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
                
                $result = $this->db->query($sql);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * insert ssc fee to salary detail
     * @param type $row
     */
    public function insert_ssc($row) {
        try {
            $filter = new Filter();
            foreach ($row as $rows) {
                $ssc_comp = $filter->sanitize($rows['ssc_comp'], "int");
                $ssc_emp = $filter->sanitize($rows['ssc_emp'], "int");
                $sql = "UPDATE salary_detail SET ssc_comp ='" . $ssc_comp . "',ssc_emp='" . $ssc_emp . "'  WHERE member_id ='" . $rows['member_id'] . "' ";
                $result = $this->db->query($sql);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * Get salary detail for each member to print
     * @param type $member_id
     */
    public function getpayslip($member_id, $month, $year) {
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
    public function getallowanceBymember_id($member_id) {
        try {
            $sql = "select * from allowances where allowance_id in (
select allowance_id from salary_master_allowance where member_id='" . $member_id . "')";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
    }

    /**
     * Get salary detail for each month
     */
    public function getsalarydetail() {
        try {
            $row = $this->modelsManager->createBuilder()
                    ->columns(array('salarymas.*', 'core.*'))
                    ->from(array('salarymas' => 'salts\Salary\Models\SalaryMaster'))
                    ->leftjoin('salts\Core\Models\Db\CoreMember', 'salarymas.member_id = core.member_id', 'core')
                    ->where('salarymas.deleted_flag=0')
                    ->orderby('salarymas.created_dt desc')
                    ->getQuery()
                    ->execute();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
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

    public function seacrhsalary($cond) {

        try {
            $select = "SELECT *, (SUM(`basic_salary`)+SUM(`travel_fee`)+SUM(`overtime`)+SUM(`allowance_amount`))-(SUM(`ssc_emp`)+SUM(`absent_dedution`)+SUM(`income_tax`)) AS total  FROM core_member JOIN salary_detail ON core_member.member_id=salary_detail.member_id ";
            $conditions = $this->setCondition($cond);
            $sql = $select;
            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(' AND ', $conditions) . " and MONTH(pay_date)='" . $cond["mth"] . "' and YEAR(pay_date)='" . $cond["yr"] . "' group by core_member.member_id";
            } else {
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

    public function updatesalarydetail($bsalary, $allowancetoadd, $member_id, $salary_start_year, $salary_start_month, $absent_amount, $overtime_hr, $overtimerate) {

        $Salarymaster = new SalaryMaster();
        $SM = $Salarymaster->getTodaysalaryMaster($member_id);
        $deduce_amount = array();
        $now = new \DateTime('now');
        $budget_startmonth = '04';
        $budget_startyear = $now->format('Y') . '-04-01';
        $budget_endmonth = '03';
        $endyear = $now->format('Y') . '-03';
        $budget_endyear = date("Y-m", strtotime("+1 year", strtotime($endyear)));
        $budget_endyear_one = date("Y-m-d", strtotime("+1 year", strtotime($endyear)));
        $allowance = "";
        $salary = "";
        $salary_star_date = $salary_start_year . '-' . $salary_start_month;
        $salary_update_yr = $salary_start_year;
        $salary_update_mth = $salary_start_month;
        $resign = $this->getResigndate($member_id);
        $basic_salary = '';
        $SD = $this->getoldsalarydetail($member_id, $salary_update_yr, $salary_update_mth, $budget_endyear_one, $budget_startyear);

        if ($resign['resign_date'] != null) {
            $resigndate = explode("-", $resign['resign_date']);
            $resignyear = $resigndate[1];
            $resignmonth = $resigndate[0];
            $bsalaryparday = $SM['basic_salary'] / 24;
            $count_attdate = $this->countattdate($resign['resign_date'], $resignyear, $resignmonth, $member_id);
            $salary = $count_attdate['count_attdate'] * $bsalaryparday;
            $count_paymonth = $this->getpaysalary_month($resignyear, $resignmonth, $member_id);
            $year = $count_paymonth['count_pay_date'];
        } else {

            $date_diff = $Salarymaster->date_difference($salary_star_date, $budget_endyear);
            $basic_salary = $bsalary * $date_diff;
            echo $basic_salary;
            if (!empty($SD)) {
                $basic_salary = $basic_salary + $SD['total_salary'];
                $old_allowance = $SD['total_all_amount'] + $allowancetoadd;
                $date_to_calculate = $date_diff + $SD['count_pay'];
                echo "basic salary in salary detail " . $SD['total_salary'];
            }
            $Allowanceresult = $Salarymaster->getAllowances($SM['member_id'], $basic_salary, $date_diff, $old_allowance, $SM['status'], $SD['total_all_amount'], $SD['count_pay']);
            $basic_salary = $Allowanceresult['basic_salary_annual'];

            $ot_fees = $overtimerate * $overtime_hr;
            $basic_salary = $basic_salary + $ot_fees;

            //check the user who is absent.
            $absent = $Salarymaster->checkAbsent($member_id, $budget_startyear, $budget_endyear_one);

            //Get the data of leave setting
            $leavesetting = $Salarymaster->getleavesetting();
            //calculate absent deduce
            $countabsent = $Salarymaster->CalculateLeave($absent['countAbsent'], $leavesetting['max_leavedays'], $leavesetting['fine_amount'], $SM['basic_salary']);
            $absent_dedution = $countabsent + $absent_amount;
            $basic_salary = $basic_salary - $absent_dedution;

            $basic_deduction = $basic_salary * (20 / 100);
            echo "SALARY " . $basic_deduction;


            //calculate ssc pay amount to deduce
            if ($SM['basic_salary'] > 300000) {
        }

        $final_result[] = array('income_tax' => $taxs['tax_result'],
            'member_id' => $member_id, 'allowance_amount' => $Allowanceresult['allowance'],
        return $Result;
    }

    public function savesalaryeditdata($param, $salary_start_year, $salary_start_month) {
        try {

            $filter = new Filter();
            foreach ($param as $params) {
                $emp_ssc = (300000 * $date_to_calculate) * (2 / 100);
            } else {

                $emp_ssc = ($SM['basic_salary'] * $date_to_calculate) * (2 / 100);
            }

            $deduce_amount = $Salarymaster->getreduce($SM['member_id']);

            $total_deduce = $deduce_amount[0]['Totalamount'] + $basic_deduction + $emp_ssc;
            echo "Total deduction is " . $total_deduce;

            //taxable income (total_basic-total deduce)
            $income_tax = $basic_salary - $total_deduce;

            echo "The Income tax  is " . $income_tax . '<br>';
            $taxs = $Salarymaster->deducerate($income_tax, $date_to_calculate);
            }
        } catch (Exception $ex) {
            echo $ex;
        }
        return $result;
    }

    public function getpaysalary_month($resignmonth, $resignyear, $member_id) {

        try {
            $sql = "select count(pay_date) as count_pay_date from salary_detail where member_id='" . $member_id . "' and MONTH(pay_date)='" . $resignmonth . "' and YEAR(pay_date)<='" . $resignyear . "'";

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
    public function countattdate($resigndate, $resignyear, $resignmonth, $member_id) {
        try {
            $sql = "select count(att_date) as count_attdate from attendances where member_id='" . $member_id . "' and DATE(att_date)<='" . $resigndate . "'";
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }

    public function getoldsalary($budget_startmonth, $member_id, $salary_update_yr, $salary_update_mth) {
        try {
            $salary_update_mth = $salary_update_mth - 1;
            $sql = "select SUM(basic_salary) as total_salary,COUNT(pay_date)as count_pay from salary_detail where member_id='" . $member_id . "' and MONTH(pay_date)<='" . $salary_update_mth . "' and YEAR(pay_date)='" . $salary_update_yr . "' and MONTH(pay_date)>='" . $budget_startmonth . "'";
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $row;
    }

    public function getoldsalarydetail($member_id, $salary_update_yr, $salary_update_mth, $budget_endyear_one, $budget_startyear) {
        try {
            $sql = "select SUM((case when (basic_salary) then basic_salary else 0 end))as total_salary,COUNT(pay_date)as count_pay, SUM(allowance_amount) as total_all_amount,"
                    . "SUM((case when (overtime) then overtime else 0 end)) as total_overtime from salary_detail where member_id='" . $member_id . "' and YEAR(pay_date)<='" . $salary_update_yr . "' and MONTH(pay_date)>'" . $salary_update_mth . "'";
            $result = $this->db->query($sql);
            $row = $result->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $row;
    }

    public function addresign($data) {
        try {
            $sql = "Update salary_detail SET resign_date ='" . $data['resign_date'] . "' Where member_id='" . $data['member_id'] . "'";
            $this->db->query($sql);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    /**
     * Saw Zin Min Tun     
     */
    public function findmonthyear($monthyear) {
        // Check if the user exist
        $monthyear = $monthyear;
        $this->db = $this->getDI()->getShared("db");
        $query = "SELECT * FROM salary_detail where month(pay_date) =month(' " . $monthyear . " ')  and year(pay_date) =year(' " . $monthyear . " ')  and deleted_flag=0";
        $user = $this->db->query($query);
        $user = $user->fetchAll();
        return $user;
    }

    public function searchSList($param) {
        try {
            if ($param['travel_fees'] == 1) {
                $field = "travel_fee_perday";
            }
            if ($param['travel_fees'] == 2) {
                $field = "travel_fee_permonth";
            }
            $select = "SELECT salary_master.member_id,member_login_name,basic_salary," . $field . ",over_time,ssc_emp,ssc_comp FROM salary_master"
                    . " join core_member on salary_master.member_id=core_member.member_id";
            $select .= " WHERE " . $field . " <> 0";
            if ($param['user_id'] !== "") {
                $select .= " and salary_master.member_id='" . $param["user_id"] . "'";
            }
            $result = $this->db->query($select);
            $row = $result->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $row;
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @since 1/27/2016
     * @desc Salary Detail calculate by csv 
     */
    public function getSalaryDetailField() {
        $query = "show columns from salary_detail";
        $data = $this->db->query($query);
        $rows = $data->fetchall();
        return $rows;
    }

    public function getHeader($param) {
        $n = 0;
        $header = array();
        $getField = ["member_id" => 0, "basic_salary" => 1, "basic_salary_annual" => 2, "travel_fee" => 3,
            "overtime" => 4, "allowance_amount" => 5, "ssc_comp" => 6, "ssc_emp" => 7, "absent_dedution" => 8,
            "income_tax" => 9, "total_annual_income" => 10, "basic_examption" => 11, "pay_date" => 12];
        foreach ($param as $v) {
            if (array_key_exists($v['Field'], $getField)) {
                if ($n === 0) {
                    $header[] = strtoupper($v["Field"]) . "(X)";
                } else if ($n === 1) {
                    $header[] = "MEMBER_NAME(X)";
                    $header[] = "FULL_NAME(X)";
                    $header[] = strtoupper($v["Field"]) . "(INT)";
                } else if ($n === 12) {
                    $header[] = strtoupper($v["Field"]) . "(Y-M-D)";
                } else {
                    $header[] = strtoupper($v["Field"]) . "(INT)";
                }
                $n++;
            }
        }
        return $header;
    }

    public function importsalary($data) {
        try {
            $salDetail = new SalaryDetail();
            $filter = new Filter();
            $da = array();
            $return = array();
            $da["id"] = uniqid();
            $da['member_id'] = $filter->sanitize(isset($data[0]) ? $data[0] : "", "string");
            $da['basic_salary'] = $filter->sanitize(isset($data[3]) ? $data[3] : "", "int");
            $da["basic_salary_annual"] = $filter->sanitize(isset($data[4]) ? $data[4] : "", "int");
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
            (0 !== $paydate) ? $da['pay_date'] = date("Y-m-d", strtotime($paydate)) : $da['pay_date'] = null;
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
        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * Saw Zin Min Tun     
     */
    public function addmemberid($member_id, $paydate) {
        $this->db = $this->getDI()->getShared("db");
        foreach ($member_id as $result) {
            $query = "UPDATE salary_detail SET  print_id = 1 where member_id ='" . $result . "' and pay_date='" . $paydate . "'";
            $output = $this->db->query($query);
        }
        return $output;
    }

    /**
     * Saw Zin Min Tun     
     */
    public function colorprint() {
        $this->db = $this->getDI()->getShared("db");
        $query = "SELECT * FROM salary_detail where print_id = 1 and deleted_flag=0";
        $user = $this->db->query($query);
        $users = $user->fetchAll();
        return $users;
    }

}
