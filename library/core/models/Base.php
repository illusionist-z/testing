<?php

namespace Library\Core\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Base extends \Phalcon\Mvc\Model {
    
    // Don't use count function (light weight)
    const RESULTS_MODE_MORE   = 1;
    
    // Change mode to paging mode (Use count function so heavy weight)
    const RESULTS_MODE_PAGING = 2;
    
    // For export data
    const RESULTS_MODE_EXPORT = 3;
    
    const FETCH_MODE_ARRAY = 'fetchAll';
    
    const FETCH_MODE_ASSOC = 'fetchAssoc';
    
    /**
     * DB object
     * @var object 
     */
    public $db;
    
    /**
     * Default limit
     * @var type 
     */
    protected $_limit = 200;
        
    /**
     * Next page number
     * When next page is not existed will return false.
     * @var type 
     */
    protected $_next_page = false;
    /**
     * Fetch mode
     * @var type 
     */
    protected $fetch_mode = self::FETCH_MODE_ARRAY;
    
    /**
     * Is export.
     * When this parameter is true , then pager function will be not export.
     * @var type 
     */
    protected $result_mode = self::RESULTS_MODE_MORE;
    
    /**
     * Limit for exporting data
     * @var type 
     */
    protected $_limit_export = 50000;
    
    protected $_total_record = 0;
    
    /**
     * Flag of using exports function
     * @var boolean 
     */
    protected $_use_export = false;

    
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
            $select = $this->query()->columns($cols)
                    ->where($find_feild . ' = :'.$find_feild . ':',
                            [$find_feild => $find_value])
                    ->andWhere('deleted_flag = :deleted_flag:',
                            ['deleted_flag'=>$deleted_flag])
            ;
            $row = $select->execute()->getFirst();
            return $row;
            
        }  catch (\PDOException $e){
            throw $e;
        }
        return FALSE;
    }
    
    
    /**
     * Get list by search conditions
     * @param array $conds search condition (key value) 
     * If you want to set or condition etc,
     * you should set key or $conds['__statments'] = ['fieldA = ? OR fieldB = ?' => $search_word] 
     * @param array $cols field columns
     * @param intager $page Page number
     * @author Kohei Iwasa <kiwasa@gnext.co.jp>
     * @since 2015-08-12
     * @version 2015-08-20 Kohei Iwasa <kiwasa@gnext.co.jp>
     * Added a function of pagging
     */
    public function getListByConds( $conds , $cols = '*' , $page = 1){
        // Default parameter of $orConds is null
        $select = $this->query()->columns($cols);
        return $this->_getListByConds($select, $conds, $page);
        
    }
    
    /**
     * Get list by search conditions for join and etc.
     * @param type $select
     * @param type $conds
     * @param type $page
     * @return array
     */
    public function _getListByConds($select,$conds,$page){
        try{
            // set search condition
            $this->setConditions($select, $conds);
            
            $fetchmode = $this->fetch_mode;
            
            // Check the mode for exporting or searching.
            switch ($this->result_mode){
                case self::RESULTS_MODE_MORE;
                    // Paging . When you want to set limit for each modules,
                    // you need to write "protected $_limit={$num}" in the module model.
                    $select->limitPage($page, $this->_limit + 1);
                    $sql = $select->__toString();
                    
                    $list = $this->_db->$fetchmode($sql);
            
                    // Set next page number
                    if($this->_limit < count($list)){
                        array_pop($list);
                        $this->_next_page = $page +1;
                    }else{
                        $this->_next_page = FALSE;
                    }
                    
                    break;
                case self::RESULTS_MODE_PAGING;
                    // For debug
                    $sql = $select->__toString();
                    
                    // Get paginator
                    $adapter  = new Zend_Paginator_Adapter_DbSelect($select);
                    $list = new Zend_Paginator($adapter);

                    // Set current page number
                    $list->setCurrentPageNumber($page);

                    // Set Item count per page
                    $list->setItemCountPerPage($this->_limit);
                    break;
                
                case self::RESULTS_MODE_EXPORT;
                    // When export mode is true , nothing to paging function
                    $select->limit($this->_limit_export);
                    $sql = $select->__toString();
                    $list = $this->_db->fetchAll($sql);
                    $this->_next_page = FALSE;
                    break;
            }
            // Set next page number
            
        } catch (Exception $ex) {
            $this->catchException($ex);
            $list = array();
        }
        return $list;
    }
    /**
     * Pagination for table or page
     * @param object $row
     * @author David JP <david.gnext@gmail.com>
     * @since 03/29/2016
     */
    public function pagination ($row,$current_page) {
          $paginator = new PaginatorModel(
                    array(
                "data" => $row,
                "limit" => 40,
                "page" => $current_page
                    )
            );
            $page = $paginator->getPaginate();
            return $page;
    }
    /**
     * Set conditions
     * @param object $select
     * @param array $conditions
     * @throws Exception
     * @author Kohei Iwasa <kiwasa@gnext.co.jp>
     * @since 2015-08-12
     */
    protected function setConditions(&$select, $conditions){
        
        $from_array = $select->getPart(Zend_DB_Select::FROM);
        $alias = $this->_name;
        foreach($from_array as $key => $from){
            if('from' == $from['joinType']){
                $alias = $key;
                break;
            }
        }
        
        try{
            foreach ($conditions as $field => $cond){
                // Set order by
                if('order' === strtolower($field)){
                    if(is_array($cond)){
                        foreach($cond as $order){
                            $select->order($order);
                        }
                    }else{
                        $select->order($cond);
                    }
                    continue;
                }

                // Set group 
                if('group' === strtolower($field)){
                    if(is_array($cond)){
                        foreach($cond as $group){
                            $select->group($group);
                        }
                    }else{
                        $select->group($cond);
                    }
                    continue;
                }
            
                $this->__setConditions($select, $alias.'.'.$field , $cond);
            }
            
            if(FALSE === isset($conditions['delete_flag'])){
                $select->where($alias.'.delete_flag=0');
            }
            
        } catch (Zend_Db_Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * Set a search condition for parent function of setConditions
     * @param type $select
     * @param type $field
     * @param type $condition
     * @return type
     * @throws Zend_Db_Exception
     * @throws Exception
     * @author Kohei Iwasa <kiwasa@gnext.co.jp>
     * @since 2015-08-25
     */
    protected function __setConditions(&$select , $field , $condition){
        try{
            if("" == $condition) return;
            
            if(false === is_array($condition)){
                throw new Zend_Db_Exception($field.' is not a hash');
            }
            
            foreach($condition as $search_operators => $values){
                if('' === $values){
                    return;
                }
                
                switch (strtolower($search_operators)){
                    case 'eq': // equals
                        $select->where("{$field} = ?",$values);
                        break;
                    case 'neq': // not equals
                        $select->where("{$field} != ?",$values);
                        break;
                    case 'pm': // partial match 部分一致
                        $select->where("{$field} LIKE ?",'%'.$values.'%');
                        break;
                    case 'npm': // not partial match 部分一致を除外
                        $select->where("{$field} NOT LIKE ?",'%'.$values.'%');
                        break;
                    case 'bw':  // begins with 前方一致
                        $select->where("{$field} LIKE ?", $values.'%');
                        break;
                    case 'nbw': // not begins with 前方一致
                        $select->where("{$field} NOT LIKE ?", $values.'%');
                        break;
                    case 'ew':  // ends with 後方一致
                        $select->where("{$field} LIKE ?", '%' . $values);
                        break;
                    case 'new': // not ends with 後方一致を除外
                        $select->where("{$field} NOT LIKE ?", '%' . $values);
                        break;
                    case 'in': // include
                        if(0 == count($values)) return;
                        $select->where("{$field} IN (?)", $values);
                        break;
                    case 'nin': // not include
                        if(0 == count($values)) return;
                        $select->where("{$field} NOT IN (?)", $values);
                        break;
                    case 'gt':  // greater than
                        $select->where("{$field} > ?", $values);
                        break;
                    case 'gte': // greater than or equals 
                        $select->where("{$field} >= ?", $values);
                        break;
                    case 'lt':  // less than
                        $select->where("{$field} < ?", $values);
                        break;
                    case 'lte': // less than or equals
                        $select->where("{$field} <= ?", $values);
                        break;
                }
            }
        } catch (Zend_Db_Exception $ex) {
            throw $ex;
        }
    }
    
    static function findFirst($parameters = null) {
        parent::findFirst($parameters);
    }
}
