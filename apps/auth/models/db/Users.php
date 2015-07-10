<?php namespace workManagiment\Auth\Models\Db;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Users extends \Lib\Core\BaseModel{
    
    public function initialize() {
        parent::initialize();
    }
    
//    static public function findFirstByLogin($login_name){
//        
//        try{
//            $row = $this->findFirst(array(
//                    "login_name LIKE :login_name:",
//                    "bind" => ['login_name'=> $login_name ]
//                ));
//        }  catch (\Exception $e){
//            throw $e;
//        }
//        
//        return $row;
//    }
}