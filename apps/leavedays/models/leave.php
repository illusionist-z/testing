<?php

namespace workManagiment\Leavedays\Models;

use Phalcon\Mvc\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Leave extends Model {

    /**
     * Get today attendance list
     * @return type
     * @author suzin
     */
   
    public function applyleave($id, $sdate, $edate, $type, $desc){
        
        $this->db=$this->getDI()->getShared("db");      
	if ($sdate != NULL && $edate != NULL && $desc != NULL) {
            if (isset($sdate) AND isset($edate) AND isset($desc)) {
                
                $today = date("Y-m-d");             
                $checkday=date("Y-m-d",strtotime("+7 days"));//check before week     
                $sdate=date("Y-m-d",strtotime($sdate));
                $edate=date("Y-m-d",  strtotime($edate));
                if ($sdate >= $checkday && $edate >= $checkday) {
                    
                    $leave_day = (strtotime($edate) - strtotime($sdate)) / 86400;   //for calculate leave day             
                    $result = $this->db->query("INSERT INTO leaves (member_id,date,start_date,end_date,leave_days,leave_category,leave_description) VALUES('" . $id . "','" . $today . "','" . $sdate . "','" . $edate . "','" . $leave_day . "','" . $type . "','" . $desc . "')");
                    echo '<script type="text/javascript">alert("Your Leave Applied Successfully! ")</script>';
                  //echo "<script>window.location.href='applyleave';</script>";exit;
            
                }
                else{
                  echo '<script type="text/javascript">alert("Apply Leave Before a week ")</script>';
                  //echo "<script>window.location.href='applyleave';</script>";exit;
            
                }
            }
            }
         else {
                echo '<script type="text/javascript">alert("Please,Insert All Data! ")</script>';
                 // echo "<script>window.location.href='applyleave';</script>";exit;
            
        }    
}
}
