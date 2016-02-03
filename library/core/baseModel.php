<?php

namespace Library\Core;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class BaseModel extends \Phalcon\Mvc\Model {
    public $db;
    
    public function initialize(){
        
    }
    
    public function onConstruct(){
        $this->db= $this->getDI()->getShared("db");
    }
    
    /**
     * __call
     * @param type $name
     * @param type $arguments
     * @return type
     */
    public function __call($name, $arguments) {
        
        if(strpos($name,'getOneBy',0) === 0){
            // Get one data by field name
            $feild_camel = preg_replace('/getOneBy/','',$name);
            // camel case to snake case
            $find_feild = substr(strtolower( preg_replace("/([A-Z])/u", "_$0", $feild_camel) ), 1 );//_foo_bar
            array_unshift($arguments, $find_feild);// add field name
            return call_user_func_array(array($this,'getOneBy'), $arguments);
        }
        
        // Refactor to avoid eval() script
        return call_user_func_array(array(new Vlib_Session_Key(), $name), $arguments);
    }

    /**
     * Get One by ...
     * @param type $find_feild
     * @param array $argments
     * 0 : find value
     * 1 : columns 
     * 2 : deleted_flag
     * @return int
     */
    public function getOneBy($find_feild, $find_value , $cols ='*', $deleted_flag = 0){
        try{
            $conditions = [
                'deleted_flag' => $deleted_flag,
                $find_feild    => $find_value];
            
            $select = $this->query()->columns($conditions)
                    ->where($find_feild . ' =?',$find_value)
                    ->where('deleted_flag=?',$deleted_flag);
            
            $sql = $select->__toString();
            $row = $select->execute();
            return $row;
        }  catch (\PDOException $e){
            $this->catchException($e);
            throw $e;
        }
        return FALSE;
    }

}
