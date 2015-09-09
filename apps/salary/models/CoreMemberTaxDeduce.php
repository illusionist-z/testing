<?php

namespace workManagiment\Salary\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;


class CoreMemberTaxDeduce extends Model {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    public function getdeduceBymember_id($member_id){
        try{
            $data=$this->db->query("SELECT DISTINCT deduce_id from core_member_tax_deduce where member_id='".$member_id."'");
            $result=$data->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $result;
    }
    
    
   

}
