<?php

namespace salts\Document\Models;

use Phalcon\Mvc\Model;

class SalaryDetail extends Model {

    public $pay_date;

    /**
     * Get salarylist
     * @return type
     * @author zinmon
     */
    public function salarylist($month, $year) {
        try {
            $this->db = $this->getDI()->getShared("db");
            $sql = "select *,(SUM(`basic_salary`)
                +SUM(`travel_fee`)+SUM(`overtime`)
                +SUM(`allowance_amount`))-(SUM(`ssc_emp`)+SUM(`absent_dedution`)
                +SUM(`income_tax`)) AS total from core_member as CM
                join salary_detail as SD on CM.member_id=SD.member_id 
                where CM.member_id in (select member_id from salary_detail) 
                and MONTH(SD.pay_date)='" . $month . "' "
                    . "and YEAR(SD.pay_date)='" . $year . "' GROUP BY id";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }

    public function getSalaryReferData($month, $year) {
        try {
            $this->db = $this->getDI()->getShared("db");
            $sql = "select *,(SUM(`basic_salary`)+SUM(`travel_fee`)
                +SUM(`overtime`)+SUM(`allowance_amount`))-(SUM(`ssc_emp`)
                +SUM(`absent_dedution`)+SUM(`income_tax`)) AS total 
                from core_member as CM join salary_detail as SD 
                on CM.member_id=SD.member_id where CM.member_id in (
                select member_id from salary_detail) and
                MONTH(SD.pay_date)='" . $month . "' and CM.bank_acc!=0 "
                    . "and YEAR(SD.pay_date)='" . $year . "' GROUP BY id";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }

}
