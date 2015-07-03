<?php namespace Crm\User\Models;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dept{
    
    public static function getAll(){
        try{
            $result = Db\Dept::find([
                ['level=1','delet_flag=0']
            ]);

            $depts = [];
            while ($result->valid()) {
                $row = $result->current();
                $depts[$row->dept_code] = $row->dept_name;
                $result->next();
            }
        }  catch (\Exception $e){
            $di = \Phalcon\DI\FactoryDefault::getDefault();
            $di->getShared('logger')->_error($e->getMessage());
        }
        return $depts;
        
    }
    
    public function getchildren(){
        
    }
}