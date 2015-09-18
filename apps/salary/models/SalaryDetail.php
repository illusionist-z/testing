<?php

namespace workManagiment\Salary\Models;

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Core\Models\Db\CoreMember;
use Phalcon\Filter;
use workManagiment\Attendancelist\Models\Attendances;
    

class SalaryDetail extends Model {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * Get salary list for every month
     * @return type
     * @author zinmon
     */
    public function geteachmonthsalary() {
//        $sql = "SELECT MONTH(pay_date) AS Mt,YEAR(pay_date) As Yr, (SUM(`basic_salary`)+SUM(`travel_fee`)+SUM(`ssc_comp`)) AS Total,SUM(`basic_salary`) AS salary_total,SUM(`ssc_comp`) AS Tax_total
//                FROM salary_detail
//                GROUP BY YEAR(pay_date),MONTH(pay_date)
//		order by pay_date DESC";
//        echo $sql;exit;
//        $result = $this->db->query($sql);
//        $row = $result->fetchall();
//        //print_r($row);exit;
//        return $row;
    
        $query = "SELECT  MONTH(pay_date) AS Mt,YEAR(pay_date) As Yr, (SUM(basic_salary)+SUM(travel_fee)+SUM(allowance_amount)+SUM(income_tax)+SUM(ssc_comp)+SUM(ssc_emp)) AS Total,SUM(basic_salary) AS salary_total,(SUM(income_tax)+SUM(ssc_comp)+SUM(ssc_emp)) AS Tax_total,SUM(ssc_emp) as ssc_emp_amount,SUM(ssc_comp) as ssc_comp_amount,SUM(income_tax) as income_tax_amount,SUM(allowance_amount) as allowance,SUM(travel_fee) as travel_expense  "
                . " FROM workManagiment\Salary\Models\SalaryDetail"
                . " group by YEAR(pay_date),MONTH(pay_date)"
                . " order by pay_date desc";
        $row = $this->modelsManager->executeQuery($query);
       // print_r($row);exit;
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
    public function salarylist($month,$year) {
        try {
            $sql = "select *,(SUM(`basic_salary`)+SUM(`travel_fee`)+SUM(`overtime`)+SUM(`allowance_amount`))-(SUM(`ssc_emp`)+SUM(`absent_dedution`)+SUM(`income_tax`)) AS total 
                from core_member as CM join salary_detail as SD on CM.member_id=SD.member_id where CM.member_id in (
select member_id from salary_detail) and MONTH(SD.pay_date)='" . $month . "' and YEAR(SD.pay_date)='".$year."' GROUP BY id";
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
    public function insert_salarydetail($row) {
        try {
           
            $current_date=date("Y-m-d");
            
             $filter = new Filter();
             $basic_salary = number_format($filter->sanitize($rows['basic_salary'], "int"));
             $travel_fee = number_format($filter->sanitize($rows['travel_fee'], "int"));
             $overtime_rate = $filter->sanitize($rows['overtime_rate'], "int");
             
            
            foreach ($row as $rows) {
                //$sql = "INSERT INTO salary_detail (id,member_id,basic_salary,travel_fee,overtime,pay_date) VALUES(uuid(),'" . $rows['member_id'] . "','" . $rows['basic_salary'] . "','" . $rows['travel_fee'] . "','" . $rows['overtime_rate'] . "',NOW())";
                $sql = "UPDATE salary_detail SET basic_salary ='" . $basic_salary . "', travel_fee='". $travel_fee ."', overtime='". $overtime_rate ."'  WHERE member_id ='" . $rows['member_id'] . "' and DATE(pay_date)='".$current_date."'";
               
               
                $result = $this->db->query($sql);
                
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
            //print_r($row);exit;
            foreach ($row as $rows) {
                if($rows['allowance_amount']==""){
                    $rows['allowance_amount']="0";
                }
                $sql = "INSERT INTO salary_detail (id,member_id,allowance_amount,absent_dedution,income_tax,pay_date,created_dt) VALUES(uuid(),'" . $rows['member_id'] . "','" . $rows['allowance_amount'] . "','".$rows['absent_dedution']."',".$rows['income_tax']."',NOW(),NOW())";
                //$sql = "UPDATE salary_detail SET income_tax ='" . $rows['income_tax'] . "'  WHERE member_id ='" . $rows['member_id'] . "' and pay_date= CURDATE()";
                //echo $sql.'<br>';
                $result = $this->db->query($sql);
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
    public function insert_ssc($row) {
        try {
            $filter = new Filter();
            $ssc_comp = $filter->sanitize($rows['ssc_comp'], "int");
            $ssc_emp = $filter->sanitize($rows['ssc_emp'], "int");
             
            //print_r($row);exit;
            foreach ($row as $rows) {
                //echo "Member_id ".$rows['member_id']." "." Income tax ".$rows['income_tax'].'<br>';
                $sql = "UPDATE salary_detail SET ssc_comp ='" . $ssc_comp . "',ssc_emp='" . $ssc_emp . "'  WHERE member_id ='" . $rows['member_id'] . "' ";
                //echo $sql.'<br>';
                $result = $this->db->query($sql);
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
    public function getpayslip($member_id,$month,$year) {
        try {
//            $sql = "select * from salary_detail join core_member on salary_detail.member_id=core_member.member_id where salary_detail.member_id='" . $member_id . "' and MONTH(pay_date)='".$month."' and YEAR(pay_date)='".$year."'";
//            echo $sql;
//            $result = $this->db->query($sql);
//            $row = $result->fetchall();
//            //print_r($row);
//            exit;
         //print_r("thank");exit;
          $row =   $this->modelsManager->createBuilder()
                         ->columns(array('salarydet.*', 'core.*','salarymast.*'))
                         ->from(array('salarydet' => 'workManagiment\Salary\Models\SalaryDetail'))
                         ->join('workManagiment\Core\Models\Db\CoreMember','core.member_id = salarydet.member_id','core')
                         ->join('workManagiment\Salary\Models\SalaryMaster','salarymast.member_id = salarydet.member_id','salarymast')
                         //->join('workManagiment\Attendancelist\Models\Attendances','attend.member_id = salarymast.member_id','attend')
                         ->where('salarydet.member_id = :member_id:', array('member_id' => $member_id))
                         ->andWhere('MONTH(pay_date) = :month:', array('month' => $month))
                         ->andWhere('YEAR(pay_date) = :year:', array('year' => $year))
                         ->getQuery()
                         ->execute();          
                 //print_r($row);exit;
                   /* foreach($row as $rows) {
                          echo $rows->core->member_login_name;
                          echo $rows->attendances->att_date;
                    }
                    exit;*/
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
select allowance_id from salary_master_allowance where member_id='".$member_id."')";
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
    public function getsalarydetail() {
        try {
            //echo "Thank you";exit;
           /* $sql = "select * from salary_master left join core_member on salary_master.member_id=core_member.member_id";
            $result = $this->db->query($sql);
            $row = $result->fetchall();*/
            
               $row =   $this->modelsManager->createBuilder()
                         ->columns(array('salarymas.*', 'core.*'))
                         ->from(array('salarymas' => 'workManagiment\Salary\Models\SalaryMaster'))
                         ->leftjoin('workManagiment\Core\Models\Db\CoreMember','salarymas.member_id = core.member_id','core')                         
                         ->orderby('salarymas.created_dt desc')
                         ->getQuery()
                         ->execute();          
                // print_r($row);exit;
                  /* foreach($row as $rows) {
                          echo $rows->core->member_login_name;
                          echo $rows->salarymas->basic_salary;
                          echo $rows->salarymas->travel_fee;
                          echo $rows->salarymas->over_time;
                          echo $rows->salarymas->ssc_emp;
                          echo $rows->salarymas->ssc_comp;
                          echo "<br>";
                    }
                    
                    exit;*/
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
        try{
            $sql = "select * from salary_master left join core_member on salary_master.member_id=core_member.member_id where salary_master.id ='".$member_id."'";
            $result = $this->db->query($sql);
            $row = $result->fetchall();     
        }catch(Exception $e){
            echo $e;
        }
        return $row;
    }
    public function btnedit($data){
     try{
         $filter = new Filter();
         $basic_salary = number_format($filter->sanitize($data['basesalary'], "int"));
         $travel_fee = number_format($filter->sanitize($data['travelfee'], "int"));
         $overtime = $filter->sanitize($data['overtime'], "int");
         $ssc_emp = $filter->sanitize($data['ssc_emp'], "int");
         $ssc_comp = $filter->sanitize($data['ssc_comp'], "int");
             
         $sql = "Update salary_master SET basic_salary ='". $basic_salary ."',travel_fee ='". $travel_fee ."',over_time ='". $overtime ."',ssc_emp ='". $ssc_emp ."',ssc_comp ='". $ssc_comp ."' Where id='".$data['id']."'";
         $this->db->query($sql);
     } catch (Exception $ex) {
         echo $ex;
     }
     
    }

    public function seacrhsalary($cond) {
        try {
            //print_r($cond);
            $select = "SELECT * FROM core_member JOIN salary_detail ON core_member.member_id=salary_detail.member_id ";
            $conditions = $this->setCondition($cond);
            
            $sql = $select;
            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(' AND ', $conditions) ." and MONTH(pay_date)='".$cond["mth"]."' and YEAR(pay_date)='".$cond["yr"]."'";
            }
            //echo $sql;exit;
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }

    public function setCondition($cond) {
        $salary=  explode('~', $cond['salary']);
        
        $conditions = array();

        if ($cond['username'] != "") {
            $conditions[] = "member_login_name='" . $cond['username'] . "'";
        }
        if ($cond['dept'] != "") {
            $conditions[] = "member_dept_name='" . $cond['dept'] . "'";
        }
        if ($cond['position'] != "") {
            $conditions[] = "position='" . $cond['position'] . "'";
        }
        if ($cond['salary'] != "") {
            if($salary[1]!=""){
            $conditions[] = "basic_salary>='" . $salary[0] . "' and basic_salary<='".$salary[1]."'";    
            }
            else{
            $conditions[] = "basic_salary>='" . $salary[0] . "'";
            }
        }
        return $conditions;
    }

}
