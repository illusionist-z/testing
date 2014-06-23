<?php namespace Crm\User\Models\Db;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use \Lib\Core\TextCommon;
class Users extends \Lib\Core\BaseModel{
    
    public function initialize() {        
        parent::initialize();
    }
    
    public static function getInstance()
    {
        return new self();
    }

    //put your code here
    public  function get($conditions , & $users = array())
    {
        $columns = ['id','name','dept_code','dept_name','telphone','cellular_phone','extension_number','email01','email02'];
        try{
            $select = $this->query()
                    ->columns($columns);
            
            //create find condition
            if( 
                isset($conditions['delete_flag'])
                &&  $conditions['delete_flag'] == 1
              )
            {
                $update_dt = date("Y-m-d H:i:s" ,strtotime("-5days"));
                $select->where("delete_flag = 1 AND update_dt > '$update_dt' ");
            }  else {
                $select->where('delete_flag = 0 ');
            }
            
            // dept_code
            if(
                isset($conditions['dept_code']) &&
                TextCommon::trimMultiByte($conditions['dept_code']) !== ''
            ){
                $select->andWhere('dept_code LIKE :dept_code:',['dept_code'=>$conditions['dept_code']]);
            }
            
            $result = $select->orderBy("order_string ASC")
                             ->execute();
            
            $users = $result->toArray();
        
        }  catch (\Phalcon\Mvc\Model\Exception $e){
            var_dump($e);
            return FALSE;
        }
        return TRUE;
    }
}