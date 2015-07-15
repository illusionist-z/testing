<?php

namespace workManagiment\Attendancelist\Models;

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
//use workManagiment\Attendancelist\Models\CoreMember as CoreMember;
//use workManagiment\Attendancelist\Models\Attendances as Attendances;

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
        // for search result
        if (isset($name)) {
            $results = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time')
                    ->from('Attendances')
                    
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
    /**
    *get Attendance List By User ID 
    *@author Su Zin Kyaw
    */
 
    public function getattlist($id,$month){
       $this->db = $this->getDI()->getShared("db");
        $currentmth = date('m');
     
       if (isset($month)) {
              $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Attendancelist\Models\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Attendancelist\Models\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $month .' AND workManagiment\Attendancelist\Models\Attendances.member_id =' . "'$id'" )
                    ->getQuery()
                    ->execute();
       
        
    }
    else{
            $row = $this->modelsManager->createBuilder()
                    ->columns('att_date,member_login_name,checkin_time,checkout_time,lat,lng')
                    ->from('workManagiment\Attendancelist\Models\CoreMember')
                    ->leftJoin('workManagiment\Attendancelist\Models\Attendances', 'workManagiment\Attendancelist\Models\CoreMember.member_id = workManagiment\Attendancelist\Models\Attendances.member_id ')
                    ->where('MONTH(workManagiment\Attendancelist\Models\Attendances.att_date) =' . $currentmth .' AND workManagiment\Attendancelist\Models\Attendances.member_id =' . "'$id'" )
                    ->getQuery()
                    ->execute();
            
    }
     $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 1,
            "page" => $currentPage
                )
        );
        $list = $paginator->getPaginate();
        //print_r($list);exit;
        return $list;
    }

}
