<?php

namespace salts\Document\Models;
use salts\Document\Models\SalaryDetail;
use Phalcon\Mvc\Model;

/**
 * @author David
 * @since 27/7/2015
 * @desc  To create,edit,delete event
 */
class Document extends Model {

    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * get salary information for tax
     * @return type
     */
    public function getSalaryInfo() {
        try {
            $month = date("m");
            $sql = "select * from core_member join (select member_id,deduce_name,amount from salary_taxs_deduction as STD "
                    . "join salary_member_tax_deduce as SMTD on STD .deduce_id= SMTD .deduce_id) as deduce_tbl on core_member.member_id=deduce_tbl.member_id "
                    . "JOIN salary_detail AS SD ON SD.member_id=core_member.member_id where income_tax!=0 AND MONTH(SD.pay_date)=" . $month . " GROUP BY core_member.member_id";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $row;
    }

    /**
     * get salary detail to show in ssb tax form
     * @return type
     */
    public function getSsbInfo() {
        $salary = new SalaryDetail();
        $salary =SalaryDetail::find(array(
            'order' => 'pay_date DESC',
            "limit" => 1
            ));
            
        try {
            $month = date("m",$salary[0]->pay_date);
            $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*', 'salary_detail.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->join('salts\Document\Models\SalaryDetail', 'core.member_id = salary_detail.member_id', 'salary_detail')
                ->where('MONTH(salary_detail.pay_date) = :month: ', array('month' => $month))
                ->andWhere('core.deleted_flag = 0')
                ->getQuery()
                ->execute();

        } catch (Exception $ex) {
            echo $ex;
        }
        return $row;
    }

}
