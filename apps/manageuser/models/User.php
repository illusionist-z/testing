<?php

namespace workManagiment\Manageuser\Models;

use Phalcon\Mvc\Model;
use workManagiment\Core\Models\Db;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Model {

    /**
     * Get member user list
     * @return type
     * @author david
     * 
     */
    public function userlist() {
        $user = new Db\CoreMember();
        $userlist = $user::getinstance()->getusername();
        return $userlist;
    }
    /**
     * get data by name
     * @return type
     * @author david
     */
    public function useredit($name){
        $user = Db\CoreMember::findByMemberLoginName($name);
        return $user;
    }
    
}