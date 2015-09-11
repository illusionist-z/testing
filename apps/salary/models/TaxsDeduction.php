<?php

namespace workManagiment\Salary\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;
    use Phalcon\Filter;

class TaxsDeduction extends Model {

    public function initialize() {
       //parent::initialize();
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
             $filter = new Filter();
             $deduce_name = $filter->sanitize($data['deduce_name'], "string");
             $amount = $filter->sanitize($data['amount'], "int");
         $sql = "Update taxs_deduction SET deduce_name ='".$deduce_name."',amount ='".$amount ."'  Where taxs_deduction.deduce_id='".$data['id']."'";
         $this->db->query($sql);
          
        } catch (Exception $exc) {
            echo $exc;
        }
       
        
    }
    
    public function add_deduction($data){
        try {
             $filter = new Filter();
             $deduce_name = $filter->sanitize($data['deduce_name'] , "string");
             $amount = $filter->sanitize($data['amount'], "int"); 
        $this->db->query("INSERT INTO taxs_deduction (deduce_id,deduce_name,amount) VALUES (uuid(),'" . $deduce_name . "','" . $amount . "')");
         
        
        } catch (Exception $exc) {
            echo $exc;
        }
    }
    
    
    public function delete_deduction($deduce_id){
         try {
              
        $this->db->query("DELETE FROM  taxs_deduction WHERE deduce_id='".$deduce_id."'");
         
          
        } catch (Exception $exc) {
            echo $exc;
        }
    }
    
   

}
