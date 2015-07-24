<?php

namespace workManagiment\Dashboard\Models;

use Phalcon\Mvc\Model;
date_default_timezone_set("UTC");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendances extends Model {

    /**
     * Get today attendance list
     * @return type
     * @author suzin
     */
   
    public function setcheckintime($id,$note,$lat,$lon){
        
        $this->db=$this->getDI()->getShared("db");      
	$mydate=date("Y-m-d H:i:s");
        $today=date("Y:m:d");       
        $att =Attendances::findFirst("att_date = '$today' AND member_id='$id'");
        /**
          Condition : Already Checked in or not
         * */
        if ($att != NULL) {
            
                        echo "<script>alert('Already Checked in');</script>";
                        echo "<script>window.location.href='direct';</script>"; 
        } else {


           $this->db->query("INSERT INTO attendances (checkin_time,member_id,att_date,lat,lng) VALUES ('" . $mydate . "','" . $id . "','" . $today . "','" . $lat . "','" . $lon . "')");

            echo '<script type="text/javascript">alert("Successfully Checked In ")</script>';
            echo "<script>window.location.href='direct';</script>"; 
            
        }
         
    }
    
    public function setcheckouttime($id){
        $mydate = date("Y-m-d H:i:s");
        $today = date("Y:m:d");
        $this->db = $this->getDI()->getShared("db");
        $att = Attendances::find();
        $last = $att->getLast();
        $checkout = $last->checkout_time;
        $checkin = $last->checkin_time;
        $date = $last->att_date;
        /**
          Condition : Check Last data check out=NULL OR NOT
         * if checkout time exists,check today check in or not
         * */
       if ($checkout!=0){    
                 $att =Attendances::findFirst("att_date = '$today' AND member_id='$id'");
                 //Check today check in or not
                if ( $att!=NULL){ 
                  
                     $outtime=$att->checkout_time;
                     //check already checkout or not
                     if($outtime!=0)
                     {
                        echo '<script type="text/javascript">alert("Already Checkout ")</script>';
                        echo "<script>window.location.href='index';</script>"; exit;
                         
                     }
                     else{
                      $a=$this->db->query("UPDATE attendances SET checkout_time='".$mydate."' WHERE att_date='".$today."'");
                      echo '<script type="text/javascript">alert("Successfully Checked Out! ")</script>';
                      echo "<script>window.location.href='direct';</script>"; 
                        
                     }
                }
                 else{
                    
                    //check in first
                     echo '<script type="text/javascript">alert("Please Check in first ")</script>';
                       echo "<script>window.location.href='index';</script>";exit;
                }
            }
            else{
                //insert checkout time for last data
                $a=$this->db->query("UPDATE attendances SET checkout_time='".$mydate."' WHERE checkin_time='".$checkin."'");
                echo '<script type="text/javascript">alert("Successfully Checked Out! ")</script>';
                echo "<script>window.location.href='direct';</script>"; 
            }
            
         
    }
    /**
     * @author david
     * @return array {leave name}
     * @return array {no leave name}
     */
    public function checkleave(){
        $res = array();
        $this->db = $this->getDI()->getShared("db");        
        //select where user most leave taken
        $query    ="select member_login_name from core_member where member_login_name in
                   (select member_id from leaves group by member_id having COUNT(member_id)>1)";        
        $data      =$this->db->query($query);
        //select where no leave member
        $query1    ="select member_login_name from core_member where member_login_name not in
                   (select member_id from leaves) limit 4";        
        $data1      =$this->db->query($query1);        
        $res['leave_name']= $data->fetchall();
        $res['noleave_name']=$data1->fetchall();
        return $res;
    }
        
   
}
