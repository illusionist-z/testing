<?php

namespace salts\Core\Models;

use salts\Core\Models;
use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Permission {    
    static $_table_object;

    public static function getInstance() {
        return new self();
    }

    /**
     * Get permission
     * @param type $id
     * @param type $dept_code
     * @author zinmon
     */
    public function get($user, &$permissions = array(), $lang) {

        $id = $user['member_id'];
        // Get Permission groups
        $permissinGroups = $this->getGroup($id);
        // Get Permissons for user
        if (!$this->getPermissions($permissinGroups, $permissions, $lang)) {
            return FALSE;
        }
        $result = $this->getPermissions($permissinGroups, $permissions, $lang);
        return $result;
    }

    /**
     * Get Permission Groups 
     * @param string $id
     * @param string $dept_code
     * @return array Permission code.
     */
    public function getGroup($id) {
        try {
            $permissions = CorePermissionRelMember::findByRelMemberId($id);
            $permissionGroups = [];

            while ($permissions->valid()) {
                foreach ($permissions as $robot) {
                    $permissionGroups[] = $robot->permission_group_id_user;
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
    public function getPermissions($permissionGroups, & $permissions, $lang) {

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

            $results = CorePermissionGroup::find([
                        'page_rule_group IN (' . implode(',', $inFields) . ') ',
                        'bind' => $aryBind
            ]);

            // The permissions set up for each module. 
            foreach ($results as $row) {
                $permis = new CorePermission();
                //get language module foreach               
                $permissions = $permis->moduleLang($row->permission_code, $lang);
                if ($permissions) {
                    $i = 0;
                    foreach ($permissions as $res) {
                        $per_result[$res['permission_code']][] = $res[2];             //get translate menu text
                        $per_result[$res['permission_code']]['link' . $i] = $res[1];    //get link text
                        $i++;
                    }
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }
        return $per_result;
    }

    public function pagination($row,$currentPage) {
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 3,
            "page" => $currentPage
                )
        );

// Get the paginated results
        $page = $paginator->getPaginate();
        return $page;
    }
    /**
     * @author David JP <david.gnext@gmail.com>
     * change simpler result object to pdo table object
     * @param object $parameters     
     */
    public static function tableObject($parameters){
      foreach($parameters as $object_data){
          self::$_table_object = $object_data;
      }
      return self::$_table_object;
    }

}
