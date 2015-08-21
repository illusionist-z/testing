<?php

namespace workManagiment\Manageuser\Models;
use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
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
    public function userlist($username) {     
        if($username == null){
           $user = Db\CoreMember::getusername();
        }
        else{            
        $user = Db\CoreMember::getusername($username);                
        }
        return $user;
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
                      array('options'=>array('regexp'=>'/^[0-9]*$/')))?true:false;                
        $res['uname']= filter_var($cond['name'],FILTER_VALIDATE_REGEXP,
                      array('options'=>array('regexp'=>'/([^\s])/')))?true:false;
        $res['dept']= filter_var($cond['dept'],FILTER_VALIDATE_REGEXP,
                      array('options'=>array('regexp'=>'/([^\s])/')))?true:false;
        $res['pos'] = filter_var($cond['position'],FILTER_VALIDATE_REGEXP,
                      array('options'=>array('regexp'=>'/([^\s])/')))?true:false;
        if($res['mail'] && $res['pno'] && $res['uname'] && $res['dept'] && $res['pos']){                   
        $this->db = $this->getDI()->getShared("db");        
        $query = "Update core_member SET member_login_name='".$cond['name']."',member_dept_name='".$cond['dept']."',member_mobile_tel='".$cond['pno']."',member_mail='".$cond['email']."',job_title='".$cond['position']."',member_address='".$cond['address']."' Where member_id='".$cond['id']."'";
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
         $this->db->query("Delete from core_permission_rel_member where rel_member_id ='".$id."'");
    }
}
