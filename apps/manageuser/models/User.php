<?php

namespace salts\Manageuser\Models;

use Phalcon\Mvc\Model;
use salts\Core\Models\Db;

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
    public function userList($username, $currentPage) {
        if ($username == null) {
            $user = Db\CoreMember::getInstance()->getUserName($currentPage);
        } else {
            $user = Db\CoreMember::getInstance()->getOneUsername($username, $currentPage);
        }
        return $user;
    }

    public function alluserlist() {
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE deleted_flag=0");
        $users = $user->fetchall();
        return $users;

//        $row = $this->modelsManager->createBuilder()->columns(array('core.*'))
//                        ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
//                        ->where('core.deleted_flag = 0')
//                        ->getQuery()->execute();
//        return $row;
    }

    public function searchresult($name) {
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_login_name='" . $name . "' AND deleted_flag=0");
        $user = $user->fetchall();
        return $user;
    }

    /**
     * get data by name
     * @return type
     * @author david
     */
    public function userEdit($id) {
        $user = Db\CoreMember::findByMemberId($id);
        return $user;
    }

    /**
     * @since  20/7/15
     * @author David
     * @desc  edit by cond
     * @return true or false
     * @param type $cond {array}
     */
    public function editByCond($cond) {
        $res = array();
        $res['mail'] = filter_var($cond['email'], FILTER_VALIDATE_EMAIL) ? true : false;    //check valid mail
        $res['pno'] = filter_var($cond['pno'], FILTER_VALIDATE_REGEXP, //check valid phone no
                        array('options' => array('regexp' => '/^[0-9]*$/'))) ? true : false;
        $res['uname'] = filter_var($cond['name'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/([^\s])/'))) ? true : false;
        $res['dept'] = filter_var($cond['dept'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/([^\s])/'))) ? true : false;
        $res['pos'] = filter_var($cond['position'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/([^\s])/'))) ? true : false;
        if ($res['mail'] && $res['pno'] && $res['uname'] && $res['dept'] && $res['pos']) {
            $core_table = Db\CoreMember::findByMemberId($cond['id']);

            $core_table_update = \salts\Core\Models\Permission::tableObject($core_table);
            $core_table_update->member_login_name = $cond['name'];
            $core_table_update->full_name = $cond['full_name'];
            $core_table_update->member_dept_name = $cond['dept'];
            $core_table_update->bank_acc = $cond['bank'];
            $core_table_update->ssn_no = $cond['ssn'];
            $core_table_update->mm_name = $cond['mm_name'];
            $core_table_update->member_mobile_tel = $cond['pno'];
            $core_table_update->member_mail = $cond['email'];
            $core_table_update->position = $cond['position'];
            $core_table_update->member_address = $cond['address'];
            $core_table_update->working_start_dt = $cond['work_sdate'];
            $core_table_update->update();
            $res['valid'] = true;
        } else {
            $res['valid'] = false;
        }
        return $res;
    }

    /**
     * @version David JP<david.gnext@gmail.com>
     * @param string $id     
     */
    public function userDelete($id) {
        $core_member = Db\CoreMember::findByMemberId($id);
        $core_delete = \salts\Core\Models\Permission::tableObject($core_member);
        $core_delete->deleted_flag = 1;
        $core_delete->update();
        $core_rel_member = \salts\Core\Models\CorePermissionRelMember::findByRelMemberId($id);
        if (count($core_rel_member) > 0) {
            $core_rel_member_delete = \salts\Core\Models\Permission::tableObject($core_rel_member);
            $core_rel_member_delete->permission_member_group_is_deleted = 1;
            $core_rel_member_delete->update();
        }
        $salary_master = Db\SalaryMaster::findByMemberId($id);
        if (count($salary_master) > 0) {
            $salary_master_delete = \salts\Core\Models\Permission::tableObject($salary_master);
            $salary_master_delete->deleted_flag = 1;
            $salary_master_delete->update();
        }
        $absent = Db\Attendances::findByMemberId($id);
        if (count($absent) > 0) {
            $absent_delete = \salts\Core\Models\Permission::tableObject($absent);
            $absent_delete->deleted_flag = 1;
            $absent_delete->update();
        }
    }

}
