<?php
namespace workManagiment\Document\Models;
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
    public function getsalary_info() {
     try{
         $month=  date("m");
         $sql = "select * from core_member join (select member_id,deduce_name,amount from salary_taxs_deduction as STD "
                 . "join salary_member_tax_deduce as SMTD on STD .deduce_id= SMTD .deduce_id) as deduce_tbl on core_member.member_id=deduce_tbl.member_id "
                 . "JOIN salary_detail AS SD ON SD.member_id=core_member.member_id where income_tax!=0 AND MONTH(SD.pay_date)=".$month." GROUP BY core_member.member_id";
         //echo $sql;exit;
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
    public function getssb_info() {
    try{
         $month=  date("m");
         $sql = "SELECT * FROM salary_detail JOIN core_member ON salary_detail.member_id=core_member.member_id "
                 . "WHERE MONTH(pay_date)=".$month." GROUP BY core_member.member_id";
         //echo $sql;exit;
         $result = $this->db->query($sql);
         $row = $result->fetchall();
     } catch (Exception $ex) {
         echo $ex;
     }
     return $row;
    }
}
