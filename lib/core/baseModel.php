<?php namespace Lib\Core;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class BaseModel extends \Phalcon\Mvc\Model{
    
    public $logger;
    
    public function initialize() {
        $di = \Phalcon\DI\FactoryDefault::getDefault();
        $this->logger = $di->getShared('logger');
    }
}
