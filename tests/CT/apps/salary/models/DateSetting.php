<?php

namespace salts\Salary\Models;

use Phalcon\Mvc\Model;
use salts\Salary\Models;
class DateSetting extends Models\SalaryDateSetting {


    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }

   public function getdata(){
           try {
               $this->db = $this->getDI()->getShared("db");
            $sql = "select * from salary_date_setting";
            $result = $this->db->query($sql);
            $row = $result->fetchArray();
        } catch (Exception $e) {
            echo $e;
        }
        return $row;
   }
   
   public function editdata($start,$end){
       try {
            $sql = "UPDATE `salary_date_setting` SET `salary_date_from`='".$start."',`salary_date_to`='".$end."' WHERE 1";
             $this->db->query($sql);
           
        } catch (Exception $e) {
            echo $e;
        }
   }
}
