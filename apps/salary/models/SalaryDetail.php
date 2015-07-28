<?php
namespace workManagiment\Salary\Models;
use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class SalaryDetail extends Model {
    
    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    /**
     * Get salary list for every month
     * @return type
     */
    public function geteachmonthsalary() {
       
        $sql = "SELECT MONTH(pay_date) AS Mt,YEAR(pay_date) As Yr, (SUM(`basic_salary`)+SUM(`travel_fee`)+SUM(`ssc_comp`)) AS Total,SUM(`basic_salary`) AS salary_total,SUM(`ssc_comp`) AS Tax_total
                FROM salary_detail
                GROUP BY MONTH(pay_date)";
        $result = $this->db->query($sql);
        $row = $result->fetchall();
        //print_r($row);exit;
        return $row;
    }
    
    /**
     * Get salarylist
     * @return type
     * @author zinmon
     */
    public function salarylist(){
        try {
            $sql = "SELECT member_login_name,member_dept_name,basic_salary,overtime,travel_fee,income_tax,absent_dedution, (SUM(`ssc_comp`)+SUM(`ssc_emp`)) AS ssc,
(SUM(`basic_salary`)+SUM(`travel_fee`)+SUM(`overtime`))-(SUM(`ssc_emp`)+SUM(`ssc_comp`)+SUM(`absent_dedution`)) AS total
 FROM salary_detail JOIN core_member on salary_detail.member_id=core_member.member_id GROUP BY id";
            
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }
        
        return $row;       
    }

}
