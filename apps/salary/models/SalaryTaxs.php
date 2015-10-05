<?php

namespace workManagiment\Salary\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;


class SalaryTaxs extends Model {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    public function gettaxlist(){
        try {
            $data=$this->db->query("SELECT * FROM taxs ");
            $result=$data->fetchall();
        
        } catch (Exception $exc) {
            echo $exc;
        }
         //print_r($exc);exit;
        //print_r($list);exit;
        return $result;
    }
    
    
    public function gettaxdata($id){
        try {
            $data=$this->db->query("SELECT * FROM taxs WHERE id='".$id."'");
            $result=$data->fetchall();
          
        } catch (Exception $exc) {
            echo $exc;
        }
       
        return $result;
    }
    
    public function edit_tax($data){
          try {
              $to=$data['taxs_from']-1;
              $data['taxs_diff']=$data['taxs_to']-$to;
         $sql = "Update taxs SET taxs_from ='".$data['taxs_from']."',taxs_to ='".$data['taxs_to']."',taxs_rate ='".$data['taxs_rate']."',taxs_diff ='".$data['taxs_diff']."',ssc_emp ='".$data['ssc_emp']."',ssc_comp ='".$data['ssc_comp']."'  Where taxs.id='".$data['id']."'";
         $this->db->query($sql);
          
        } catch (Exception $exc) {
            echo $exc;
        }
       
        
    }
    
    
   

}
