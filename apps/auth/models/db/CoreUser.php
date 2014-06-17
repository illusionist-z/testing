<?php namespace Crm\Auth\Models\Db;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CoreUser extends \Phalcon\Mvc\Model{
    
    public function login(){
        return 3;
    }
    
    static function findFirstByLogin($login_name){
        try{
//            $row = $this->db->fetchOne('SELECT * FROM `core_user`');
        }  catch (\Exception $e){
//            $s;
        }
        $di = \Phalcon\DI\FactoryDefault::getDefault();
        $di->getShared('logger')->_error('Error');
        return $row;
    }
}