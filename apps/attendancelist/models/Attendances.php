<?php

namespace workManagiment\Attendancelist\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model\Query;
//use workManagiment\Auth\Models\Db\CoreMember as corememberresult;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendances extends Model {

    /**
     * Get today attendance list
     * @return type
     * @author zinmon
     */
  
    public function gettodaylist($name) {
        $this->db = $this->getDI()->getShared("db");
        $today = date("Y:m:d");
        //$core_member=new CoreMember();
        //$aa=new \workManagiment\Auth\Models\Db\CoreMember();
        // for search result
        if (isset($name)) {
            
//            $sql = "SELECT * FROM attendances JOIN core_member ON attendances.member_id=core_member.member_id WHERE attendances.att_date='" . $today . "' and member_login_name='" . $name . "'";
//            $result = $this->db->query($sql);
//            $row = $result->fetchall();
            $results = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time')
                    ->from('Attendances')
                    //->leftJoin('Attendances', 'corememberresult.member_id = Attendances.member_id ')
                    //->where('MONTH(Attendances.att_date) =' . $month)
                    ->getQuery()
                    ->execute();
            print_r($results);exit;
        } else {
            //show att today list
            $result = $this->db->query("SELECT * FROM attendances JOIN core_member ON attendances.member_id=core_member.member_id WHERE attendances.att_date='" . $today . "'");
            $row = $result->fetchall();
            //print_r($row);exit;
        }
        //print_r($row);exit;
        return $row;
    }
    
    /**
     * Get user name
     * @return type
     * @author zinmon
     */
    public function getusername() {
        $this->db = $this->getDI()->getShared("db");
        $user_name = $this->db->query("SELECT * FROM core_member");
        //print_r($user_name);exit;
        $getname = $user_name->fetchall();
        return $getname;
    }

}
