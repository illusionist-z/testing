<?php 
namespace workManagiment\Attendance\Models;
use Phalcon\Mvc\Model;


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendances extends Model{
    
    public function gettodaylist(){
        $this->db=$this->getDI()->getShared("db");
         $today=date("Y:m:d");
         $result=$this->db->query("SELECT * FROM attendances JOIN core_member ON attendances.member_id=core_member.member_id WHERE attendances.att_date='".$today."'");
         //print_r($result);exit;
         $row=$result->fetchall();  
         //print_r($row);exit;
        return $row;
        
    }
    
    public function getchildren(){
        
    }
}