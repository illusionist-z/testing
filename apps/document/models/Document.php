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
            $salary = new SalaryDetail();
             $salary =SalaryDetail::find(array(
            'order' => 'pay_date DESC',
            "limit" => 1
            ));
                $row = Array();
                if(isset($salary)){
                $data = explode("-", $salary[0]->pay_date);
                $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*', 'salary_detail.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->join('salts\Document\Models\SalaryDetail', 'core.member_id = salary_detail.member_id', 'salary_detail')
                ->where('MONTH(salary_detail.pay_date) = :month: ', array('month' => $data[1]))
                ->andWhere('core.deleted_flag = 0')
                ->andWhere('salary_detail.income_tax!=0 ')
                ->getQuery()
                ->execute();}
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
            $row = Array();
            if(isset($salary)){
            $data = explode("-", $salary[0]->pay_date);
            
         
            $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*', 'salary_detail.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->join('salts\Document\Models\SalaryDetail', 'core.member_id = salary_detail.member_id', 'salary_detail')
                ->where('MONTH(salary_detail.pay_date) = :month: ', array('month' => $data[1]))
                ->andWhere('core.deleted_flag = 0')
                ->getQuery()
            ->execute();}

        } catch (Exception $ex) {
            echo $ex;
        }
        
        return $row;
    }

}
