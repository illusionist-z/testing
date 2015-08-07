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
     * Get company start date
     * @return type
     */
    public function getComp_startdate() {
        try {
            $now = new \DateTime('now');
            $month = $now->format('m');
            $year = $now->format('Y');
            date_default_timezone_set('UTC');
            $last_year=$year.'-'.$month;
            
            $last_year = date("Y", strtotime("-1 year", strtotime($last_year)));
            $last_year= $last_year.'-04-01';
            // Start date
            $date = $last_year;
            // End date
            $end_date = $year.'-05-31';

            while (strtotime($date) <= strtotime($end_date)) {
                //echo "$date<br>";
                $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
                 $sql = "select pay_date from salary_detail where DATE(pay_date)='" . $date . "'";
            //echo $sql . '<br>';
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            }
            print_r($row);exit;
            //exit;
//            $sql = "select pay_date from salary_detail where YEAR(pay_date)='" . $year . "' and MONTH(pay_date)='" . $month . "'";
//            echo $sql . '<br>';
//            $result = $this->db->query($sql);
//            $row = $result->fetchall();
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
    public function salarylist($month) {
        try {
            $sql = "select *,(SUM(`basic_salary`)+SUM(`travel_fee`)+SUM(`overtime`))-(SUM(`ssc_emp`)+SUM(`absent_dedution`)) AS total from core_member as CM join salary_detail as SD on CM.member_id=SD.member_id where CM.member_id in (
select member_id from salary_detail) and MONTH(SD.pay_date)='" . $month . "'GROUP BY id";
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
            //print_r($row);exit;
            foreach ($row as $rows) {

                $sql = "INSERT INTO salary_detail (id,member_id,basic_salary,travel_fee,overtime,pay_date) VALUES(uuid(),'" . $rows['member_id'] . "','" . $rows['basic_salary'] . "','" . $rows['travel_fee'] . "','" . $rows['overtime_rate'] . "',NOW())";

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
                //echo "Member_id ".$rows['member_id']." "." Income tax ".$rows['income_tax'].'<br>';
                $sql = "UPDATE salary_detail SET income_tax ='" . $rows['income_tax'] . "'  WHERE member_id ='" . $rows['member_id'] . "' ";
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
            //print_r($row);exit;
            foreach ($row as $rows) {
                //echo "Member_id ".$rows['member_id']." "." Income tax ".$rows['income_tax'].'<br>';
                $sql = "UPDATE salary_detail SET ssc_comp ='" . $rows['ssc_comp'] . "',ssc_emp='" . $rows['ssc_emp'] . "'  WHERE member_id ='" . $rows['member_id'] . "' ";
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
    public function getpayslip($member_id) {
        try {
            $sql = "select * from salary_detail join core_member on salary_detail.member_id=core_member.member_id where salary_detail.member_id='" . $member_id . "'";
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
            $sql = "select * from salary_master left join core_member on salary_master.member_id=core_member.member_id";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
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
            $sql = "select * from salary_master left join core_member on salary_master.member_id=core_member.member_id";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function seacrhsalary($cond) {
        try {
            $select = "SELECT * FROM core_member JOIN salary_detail ON core_member.member_id=salary_detail.member_id ";
            $conditions = $this->setCondition($cond);

            $sql = $select;
            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(' AND ', $conditions);
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

        $conditions = array();

        if ($cond['username'] != "") {
            $conditions[] = "member_login_name='" . $cond['username'] . "'";
        }
        if ($cond['dept'] != "") {
            $conditions[] = "member_dept_name='" . $cond['dept'] . "'";
        }

        return $conditions;
    }

}
