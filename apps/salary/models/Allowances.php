<?php

namespace workManagiment\Salary\Models;

use Phalcon\Mvc\Model;

class Allowances extends Model {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
   
    public function addallowance($all_value,$all_name,$count){
     
    $this->db=$this->getDI()->getShared("db");  
     for ($x = 1; $x <$count; $x++) {
     //echo $all_name['"'.$x.'"'];echo $all_value['"'.$x.'"'];
    $this->db->query("INSERT INTO allowances (allowance_id,allowance_name,allowance_amount) VALUES (uuid(),'" . $all_name['"'.$x.'"'] . "','" . $all_value['"'.$x.'"'] . "')");
    }
      echo '<script type="text/javascript">alert("Allowances are Added Successfully! ")</script>';
     echo "<script type='text/javascript'>window.location.href='../../salary/index/allowance';</script>";
    }
    

}
