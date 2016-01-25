<?php

namespace salts\Salary\Models;


//use salts\Salary\Models\SalarySetting;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Mvc\Model;
use salts\Core\Models\Db\CoreMember;
use Phalcon\Mvc\Controller;
use Phalcon\Filter;

class Salary extends \Library\Core\BaseModel {
     public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
     public function chk_validate($data){
         
        $ress= array();
        $validate = new Validation();
        $validate->add('uname',
                new PresenceOf(
                array(
                    'message' => ' * Username is required'
                     )
                     ));
        $validate->add('bsalary',
                new PresenceOf(
                array(
                    'message' => ' * Basic Salary is required'
                     )
                     ))
                ->add('checkall',
                new PresenceOf(
                array(
                    'message'=> ' * Check is required'
                )));                
       
        
        
        $messages = $validate->validate($data);
        if (count($messages)) {
                                foreach ($messages as $message) {
                                     $ress[] =$message;
                                }
                              }
        return $ress;
     }

     public function getHeader($param) {
         $header = array();$n = 0;$num= 0;
         //get want field name
         $getField = array("member_id"=>0,"basic_salary"=>1,"travel_fee_perday"=>2,
             "travel_fee_permonth"=>3,"over_time"=>4,"ssc_emp"=>5,"ssc_comp"=>6,"salary_start_date"=>7);
            foreach ($param as $k=>$j) {
            foreach($j as $v){
                if($k === 0 ){
                    if(array_key_exists($v["Field"], $getField)){
                        if($n === 0){
                            $header[] = strtoupper($v["Field"])."(don't edit)";
                        }
                        else if($n === 1){
                            $header[] = "MEMBER_NAME(don't edit)";
                            $header[] = "FULL_NAME(don't edit)";
                            $header[] = strtoupper($v["Field"])."(only Interger allow)";
                        }                        
                        else if($n === 7){
                            $header[] = strtoupper($v["Field"])."(Y-M-D[1993-04-09])";
                        }
                        else{
                            $header[] = strtoupper($v["Field"])."(only Interger allow)";
                        }                        
                        $n++;
                    }                   
                }
                else if ($k === 1){
                    if($num === 1){
                    $header[] = strtoupper($v['deduce_id'])."(No of children[0,1,...])";
                    }
                    else{
                    $header[] = strtoupper($v['deduce_id'])."(insert only 1 if allow)";
                    }
                    $num++;
                }
                else {
                    $header[] = strtoupper($v['allowance_name'])."(insert only 1 if allow)";
                }
            }            
        }
        return $header;
     }
}
