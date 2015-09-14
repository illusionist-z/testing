<?php

namespace workManagiment\Salary\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;
    use Phalcon\Filter;

class Taxs extends Model {

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
             $filter = new Filter();
             $taxs_from = $filter->sanitize($data['taxs_from'], "int");
             $taxs_to = $filter->sanitize($data['taxs_to'], "int");
             $taxs_rate = $filter->sanitize($data['taxs_rate'], "int");
             $ssc_emp = $filter->sanitize($data['ssc_emp'], "int");
             $ssc_comp = $filter->sanitize($data['ssc_comp'], "int");
             
              $to=$data['taxs_from']-1;
              $data['taxs_diff']=$data['taxs_to']-$to;
         $sql = "Update taxs SET taxs_from ='". $taxs_from ."',taxs_to ='". $taxs_to  ."',taxs_rate ='". $taxs_rate ."',taxs_diff ='".$data['taxs_diff']."',ssc_emp ='". $ssc_emp ."',ssc_comp ='". $ssc_comp ."'  Where taxs.id='".$data['id']."'";
         $this->db->query($sql);
         
        } catch (Exception $exc) {
            echo $exc;
            
        }
       
        
    }
    
    
   

}
