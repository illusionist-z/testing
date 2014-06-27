<?php namespace Crm\Core\Models\Db;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class CoreApps extends \Lib\Core\BaseModel{
    
    public function initialize() {
        parent::initialize();
    }
    
    public static function getInstance()
    {
        return new self();
    }
    
    static public function getActiveApps($auth){
        
        $modules = [];
        
        foreach ($auth as $module => $permmitions){
            echo $module.PHP_EOL.print_r($permmitions,true);
            if(in_array('show_menu', $permmitions)){
                $modules[] = $module;
            }
        }

        try{
            $this->findFirst();
        }catch(Phalcon\Exception $e){
            throw $e;
        }
    }
    
}