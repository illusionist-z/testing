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
         $sql = "select * from salary_detail join core_member on core_member.member_id=salary_detail.member_id where income_tax!=0";
         
         $result = $this->db->query($sql);
         $row = $result->fetchall();
     } catch (Exception $ex) {
         echo $ex;
     }
     return $row;
    }
}
