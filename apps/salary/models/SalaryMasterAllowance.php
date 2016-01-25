<?php

namespace salts\Salary\Models;

use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;
use salts\Salary\Models\Allowances;

class SalaryMasterAllowance extends Model {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public function getallowanceBymember_id($member_id){
        try{
            $data=$this->db->query("SELECT DISTINCT allowance_id from salary_master_allowance where member_id='".$member_id."'");
            $result=$data->fetcharray();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $result;
    }
    
    /**
     * 
     * @param type $allowance
     * @param type $member_id
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function edit_allowanceByMemberid($allowance,$member_id) {
         try{
             
            $count=  $this->getallowanceBymember_id($member_id);
            $creartor_id="admin";
            if(!empty($count)){
                $delete="DELETE FROM salary_master_allowance WHERE member_id='".$member_id."'";
                $query=  $this->db->query($delete);
                for($i=0;$i<count($allowance);$i++){
                   
                    try {
                        
                $sql = "INSERT INTO salary_master_allowance (allowance_id,member_id) VALUES('".$allowance[$i]."','". $member_id . "')";
                //echo $sql;
                $result = $this->db->query($sql);
                       
                        
                    } catch (Exception $exc) {
                        echo $exc->getTraceAsString();
                    }
                
                }
            }
            else{
                for($i=0;$i<count($allowance);$i++){
                $sql = "INSERT INTO salary_master_allowance (allowance_id,member_id) VALUES('".$allowance[$i]."','". $member_id . "')";
                //echo $sql;
                $result = $this->db->query($sql);
                }
            }
            
        } catch (Exception $ex) {
            echo $ex;
        }
        //return $result;
    }
    
    public function getallowId($d) {
        $this->db = $this->getDI()->getShared("db");                
        $sql = "Select allowance_id from allowances where allowance_name = '".$d[2]["allowance_name"]."'";
        $data = $this->db->query($sql);
       $rows = $data->fetchall();
       return $rows;
      }
}