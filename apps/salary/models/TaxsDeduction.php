<?php

namespace workManagiment\Salary\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;


class TaxsDeduction extends Model {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    public function getdedlist(){
        try {
            
           $data=$this->db->query("SELECT * FROM taxs_deduction ");
            $result=$data->fetchall();
        
        } catch (Exception $exc) {
            echo $exc;
        }
         //print_r($exc);exit;
        //print_r($list);exit;
        return $result;
    }
    
    
    public function getdectdata($id){
        try {
            $data=$this->db->query("SELECT * FROM taxs_deduction WHERE deduce_id='".$id."' ");
            $result=$data->fetchall();
          
        } catch (Exception $exc) {
            echo $exc;
        }
       
        return $result;
    }
    
    public function edit_deduction($data){
          try {
              
         $sql = "Update taxs_deduction SET deduce_name ='".$data['deduce_name']."',amount ='".$data['amount']."'  Where taxs_deduction.deduce_id='".$data['id']."'";
         $this->db->query($sql);
          
        } catch (Exception $exc) {
            echo $exc;
        }
       
        
    }
    
    public function add_deduction($data){
        try {
              
        $this->db->query("INSERT INTO taxs_deduction (deduce_id,deduce_name,amount) VALUES (uuid(),'" . $data['deduce_name'] . "','" . $data['amount'] . "')");
         
          
        } catch (Exception $exc) {
            echo $exc;
        }
    }
    
    
   

}
