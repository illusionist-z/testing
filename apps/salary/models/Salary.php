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
                    'message' => 'Username is required'
                     )
                     ));
        $validate->add('bsalary',
                new PresenceOf(
                array(
                    'message' => 'Basic Salary is required'
                     )
                     ))
                ->add('checkall',
                new PresenceOf(
                array(
                    'message'=> 'Check is required'
                )));                
       
        
        
        $messages = $validate->validate($data);
        if (count($messages)) {
                                foreach ($messages as $message) {
                                     $ress[] =$message;
                                }
                              }
        return $ress;
     }

}