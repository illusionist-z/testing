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
    
    public function alluserlist(){
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member");
        
        $user = $user->fetchall();
        return $user;
    }
    
   public function searchresult($name){
       $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_login_name='".$name."'");
        
        $user = $user->fetchall();
        return $user;
       
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
    
   
    /**
     * @since  20/7/15
     * @author David
     * @desc  edit by cond
     * @return true or false
     * @param type $cond {array}
     */
    public function editbycond($cond){    
        $res = array();
        $res['mail']= filter_var($cond['email'],FILTER_VALIDATE_EMAIL)?true:false;    //check valid mail
        $res['pno'] = filter_var($cond['pno'],FILTER_VALIDATE_REGEXP,                 //check valid phone no
                      array('options'=>array('regexp'=>'/^[0-9]+$/')))?true:false;                
        if($res['mail'] && $res['pno']){                   
        $this->db = $this->getDI()->getShared("db");        
        $query = "Update core_member SET member_login_name='".$cond['name']."',member_dept_name='".$cond['dept']."',member_mobile_tel='".$cond['pno']."',member_mail='".$cond['email']."',job_title='".$cond['position']."' Where member_id='".$cond['id']."'";
        $this->db->query($query);
        $res['valid']= true;
        }
        else{
        $res['valid']=false;             
        }
        return $res;
    }

    public function userdelete($id){
        $this->db = $this->getDI()->getShared("db");  
        $query = "Delete from core_member where member_id ='".$id."'";   
        $this->db->query($query);
    }
}
