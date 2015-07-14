<?php
namespace workManagiment\Auth\Models;
use workManagiment\Auth\Models\Db;
use Phalcon\Mvc\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Permission {

    /**
     * Get permission
     * @param type $id
     * @param type $dept_code
     * @author zinmon
     */
    public function get($user, &$permissions = array()) {
      
        $id = $user['member_id'];
        $dept_code = $user['member_dept_code'];
        
        // Get Permission groups
        $permissinGroups = $this->getGroup($id, $dept_code);
        
        // Get Permissons for user
        if (!$this->getPermissions($permissinGroups, $permissions)) {
            return FALSE;
        }
        $result=$this->getPermissions($permissinGroups, $permissions);
        //print_r($result);exit;
        return $result;
    }

    /**
     * Get Permission Groups 
     * @param string $id
     * @param string $dept_code
     * @return array Permission code.
     */
    public function getGroup($id, $dept_code) {
        try {
            $permissions = Db\CorePermissionRelMember::findByRelMemberId($id);
       //var_dump($permissions);exit;
            $permissionGroups = [];
            
            while ($permissions->valid()) {
                //$robot = $permissions->current();
                foreach ($permissions as $robot) {
                $permissionGroups[] = $robot->rel_permission_group_code;
                    //$permissionGroups[] = $robot->rel_permission_group_code;
                    //$permissions->next();
            }
            }
        } catch (\Exception $e) {
            throw $e;
        }
        return $permissionGroups;
    }

    /**
     * Get permission
     * @param type $permissionGroups
     * @param type $permissions
     * @return type
     * @author zinmon
     */
    public function getPermissions($permissionGroups, & $permissions) {

        try {
            $permissions = [];
            $bindString = [];
            $inFields = [];
            $i = 0;
            foreach ($permissionGroups as $groupCode) {
                $bindString = "permission_group_code" . $i;
                $inFields[] = ":$bindString:";
                $aryBind[$bindString] = $groupCode;
                $i ++;
            }
            // 権限グループがない場合
            if (count($inFields) == 0) {
                return FALSE;
            }
            
            $results = Db\CorePermissionGroup::find([
                        'permission_group_code IN (' . implode(',', $inFields) . ') ',
                        'bind' => $aryBind
            ]);
          
            // The permissions set up for each module. 
            while ($results->valid()) {
                //$row = $results->current();
                foreach ($results as $row) {
                $permissions = Db\CorePermission::findByPermissionCode($row->permission_code);
                    while ($permissions->valid()) {
                        //$row = $permissions->current();
//                    $per_result[$row->permission_code][] = $row->permission_name;
//                    $permissions->next();
                        foreach ($permissions as $res) {
                            $per_result[$res->permission_code][] = $res->permission_name;
                }
            }
                    //$results->next()
                }
            }
            //print_r($per_result);exit;
        } catch (\Exception $e) {
            throw $e;
        }
        return $per_result;
    }
    
}
