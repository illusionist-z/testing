<?php namespace Crm\Auth\Models;

use Crm\Auth\Models\Db;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Permission{
    
    /**
     * 
     * @param type $id
     * @param type $dept_code
     */
    public function set($user){

        $id = $user->id;
        $dept_code = $user->dept_code;

        // Get Permission groups
        $permissinGroups = $this->getGroup($id, $dept_code);
        
        // Get Permissons for user
        $permissions = $this->getPermissions($permissinGroups);
        
        if(in_array('module_tab2',$permissions['member'])){
            echo 'is permission';
        }
        var_dump($permissions);
        exit;
    }
    
    /**
     * Get Permission Groups 
     * @param string $id
     * @param string $dept_code
     * @return array Permission code.
     */
    public function getGroup($id, $dept_code){
        try{
            $permissions = Db\UsersRelPermissionGroup::findByUserId($id);

            $permissionGroups = [];
            while ($permissions->valid()) {
                $robot = $permissions->current();
                $permissionGroups[] = $robot->group_code;
                $permissions->next();
            }
        }  catch (\Exception $e){
            $di = \Phalcon\DI\FactoryDefault::getDefault();
            $di->getShared('logger')->_error($e->getMessage());
        }
        return $permissionGroups;
    
    }
    
    
    public function getPermissions($permissionGroups){
        
        try{
            $permissions = [];
            $bindString = [];
            $i = 0;
            foreach ($permissionGroups as $groupCode){
                $bindString = "permission_group_code".$i;
                $inFields[] = ":$bindString:";
                $aryBind[$bindString] = $groupCode;
                $i ++;
            }
            
            $results = Db\PermissionRelGroup::find([
                    'permission_group_code IN ('. implode(',', $inFields ).') ',
                    'bind' => $aryBind
                ]);
            while ($results->valid()) {
                $row = $results->current();
                $permissions[$row->permission_module][] = $row->permission_code;
                $results->next();
            }

        }catch (\Exception $e){
            $di = \Phalcon\DI\FactoryDefault::getDefault();
            $di->getShared('logger')->_error($e->getMessage());
        }
        return $permissions;
    }
}
