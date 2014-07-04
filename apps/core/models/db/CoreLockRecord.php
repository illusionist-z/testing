<?php namespace Crm\Core\Models\Db;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ 
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;
class CoreLockRecord extends \Lib\Core\BaseModel{
    
    public function initialize() {
        parent::initialize();
    }
    
    public static function getInstance()
    {
        return new self();
    }
    

    
}