<?php

namespace salts\Attendancelist\Models;
use Phalcon\Mvc\Model;
class Attendances extends Model {
    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }
    
    /**
     * Get today attendance list
     * @return type
     * @author zinmon
     */
    public function gettodaylist($name) {        
        $today = date("Y:m:d");


        if (isset($name)) {
            $row = $this->modelsManager->createBuilder()
                    ->columns(array('core.*', 'attendances.*'))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('core.member_login_name = :name:', array('name' => $name))
                    ->andWhere('attendances.att_date = :today:', array('today' => $today))
                    ->andWhere('core.deleted_flag = 0')
                    ->andWhere('attendances.status = 0')
                    ->getQuery()
                    ->execute();
        } else {
            $row = $this->modelsManager->createBuilder()
                    ->columns(array('core.*', 'attendances.*'))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Attendancelist\Models\Attendances', 'core.member_id = attendances.member_id', 'attendances')
                    ->where('attendances.att_date = :today:', array('today' => $today))
                    ->andWhere('core.deleted_flag = 0')
                    ->andWhere('attendances.status=0')
                    ->orderBy('attendances.checkin_time DESC')
                    ->getQuery()
                    ->execute();
        }
        return $row;
    }

    /**
     * Get user name
     * @return type
     * @author zinmon
     */
    public function getusername() {        
        $user_name = $this->db->query("SELECT * FROM core_member");
        $getname = $user_name->fetchall();
        return $getname;
    }
 /**
     * get Attendance List By User ID 
     * @author Su Zin Kyaw
     * for user
     */
    public function getattlist($id,$year,$month) {        
        $currentmth = date('m');
        
        
        if(isset($year) || isset($month)){
           $start =  date("Y-m-d",strtotime($year));
           $end =  date("Y-m-d",strtotime($month));
           $row =   $this->modelsManager->createBuilder()
                         ->columns(array('core.*', 'attendances.*'))
                         ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                         ->join('salts\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                         ->where('attendances.att_date >= :start:', array('start' => $start))
                         ->andWhere('attendances.att_date <= :end:', array('end' => $end))
                         ->andWhere('attendances.member_id = :id:', array('id' => $id))
                         ->andWhere('core.deleted_flag = 0')   
                         ->orderBy('attendances.att_date DESC')
                         ->getQuery()
                         ->execute();          
                
                    
        }else{
            
            $row =   $this->modelsManager->createBuilder()
                         ->columns(array('core.*', 'attendances.*'))
                         ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                         ->join('salts\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                         ->where('MONTH(attendances.att_date) = :currentmth:', array('currentmth' => $currentmth))
                         ->andWhere('attendances.member_id = :id:', array('id' => $id))
                          ->andWhere('core.deleted_flag = 0 and attendances.status = 0')
                         ->orderBy('attendances.att_date DESC')
                         ->getQuery()
                         ->execute();           
               
        }
        return $row;
        
    }

    /**
     * Show monthly attendance list
     * @param type $year
     * @param type $month
     * @param type $username
     * @return type
     * @author zinmon
     */
    public function showattlist() {
        //search monthly list data
            $year=date('Y');
            $month = date('m');
           
            
            $row = $this->modelsManager->createBuilder()               
                        ->columns(array('core.*', 'attendances.*'))                
                        ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                        ->join('salts\Attendancelist\Models\Attendances','core.member_id = attendances.member_id','attendances')
                        ->where('MONTH(attendances.att_date) = :month: ', array('month' => $month))
                        ->andWhere('core.deleted_flag = 0')
                        ->andWhere('attendances.status = 0')
                        ->orderBy('attendances.checkin_time DESC')
                        ->getQuery()
                        ->execute();           
                
              return $row;
    }
    
 
    /**
     * @desc   insert absent member to absent 
     * @author David
     * @param  $v[0] = member_id
     */
    public function absent() {
        //get today absent list
        $sql = "Select member_id from core_member where member_id NOT IN (select member_id from attendances where att_date = CURRENT_DATE) AND deleted_flag=0 order by created_dt desc";
        //$sql = "Select * from attendances where member_id='" . $id . "' and att_date = CURRENT_DATE";
        $absentlist = $this->db->query($sql);
        $finalresult = $absentlist->fetchall();
        if ($finalresult != null) {
            $string = "";
            //get absent member id
            foreach ($finalresult as $v) {
                $string .= "'" . $v['member_id'] . "',";
            }
            $insert_string = substr_replace($string, "", -1);
            //get absent applied leave id
            $checkleave = "SELECT member_id  FROM leaves where member_id IN ($insert_string) and CURRENT_DATE in (start_date,end_date)";
            $checkleave = $this->db->query($checkleave);
            $checkresult = $checkleave->fetchall();
            $insert = "Insert into attendances (member_id,att_date,status) VALUES ";
            //insert absent with apply leave
            if (count($checkresult) > 0) {
                   foreach ($checkresult as $v) {
                       foreach($finalresult as $k){
                           if($k['member_id'] != $v['member_id']){
                                $insert .= "('". $k['member_id'] . "',CURRENT_DATE,2),";
                           }
                       }
                    $insert .= "('". $v['member_id'] . "',CURRENT_DATE,1),";
                    
                }
            }
            //insert absent with no apply leave
            else {
             foreach($finalresult as $v){
                $insert .= "('".$v['member_id']."',CURRENT_DATE,2),";
                }
            }
            $insert = substr_replace($insert,";", -1);
            $this->db->query($insert);
            $message = "Adding is successfully";
        } else {
            $message = "Already Exist";
        }
        return $message;
    }
    
    public function GetAbsentList(){
         $query = "Select * from core_member where member_id NOT IN (Select member_id from attendances where att_date = CURRENT_DATE and status = 0) AND deleted_flag=0 order by created_dt desc";
         $list=$this->db->query($query);
         $absentlist=$list->fetchall();
         return $absentlist;
    }
    
    public function getAttTime($id) {
        $query = "select * from core_member JOIN attendances On core_member.member_id = attendances.member_id Where attendances.id ='".$id."' ";
       
        $data = $this->db->query($query);
        $result = $data->fetchall();
        return $result;
    }
    
    public function editAtt($data,$id,$offset) {
        $localtime=$this->LocalToUTC($data,$offset);
        $query = "update attendances set checkin_time='".$localtime."' where id='".$id."'";
        $this->db->query($query);
    }
    
    public function LocalToUTC($data,$offset){
        
        if ($offset<0){
           $value=$offset;
           $localtime = date("Y-m-d H:i:s",strtotime($value." minutes",strtotime($data)));
        }
        else{
           $value=$offset;
           $localtime = date("Y-m-d H:i:s",strtotime($value." minutes",strtotime($data)));
        } 
        return $localtime;
        
    }
    
     public function search_attlist($year,$month,$username) {
       
        try {
         
         $select = "SELECT * FROM core_member JOIN attendances ON core_member.member_id=attendances.member_id ";
         $conditions=$this->setCondition($year, $month, $username);
              $sql = $select;
              if (count($conditions) > 0) {
              $sql .= " WHERE " . implode(' AND ', $conditions)." AND core_member.deleted_flag = 0 and attendances.status=0 order by att_date desc";
              }
              $result = $this->db->query($sql);
              $row = $result->fetchall();
              
        } catch (Exception $ex) {
           echo $ex;            
        }
        return $row;
    }
    
    public function current_attlist() {
        try {
            $select = "Select group_concat(DAY(att_date)) as day,attendances.member_id,group_concat(status) as status,member_login_name from attendances JOIN core_member ON attendances.member_id = core_member.member_id where MONTH(CURRENT_DATE) = MONTH(attendances.att_date) group by core_member.member_id desc";
            $data = $this->db->query($select);
            $result = $data->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $result;
    }

    /**
     * Set Condition
     * @param type $year
     * @param type $month
     * @param type $username
     * @return string
     * @author zinmon
     */
    public function setCondition($year, $month, $username) {
        $conditions = array();

              if ($year) {
                  $start =  date("Y-m-d",strtotime($year));
              $conditions[] = "attendances.att_date >=  ' " . $start . " ' ";
              }
              if ($month) {
                   $end =  date("Y-m-d",strtotime($month));
              $conditions[] = "attendances.att_date <=  ' " . $end . " ' ";
              }
              if ($username) {
              $conditions[] = "member_login_name ='" . $username . "'";
              }
               
        return $conditions;
    }
    
    /**
     * get count attendance day 
     * @return type
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function getCountattday($salary_start_date) {
        try {
            $dt=  explode('-', $salary_start_date);
            $query = "select *,count(att_date) as attdate from attendances join core_member on attendances.member_id=core_member.member_id"
                    . " where YEAR(att_date)='".$dt[0]."' and MONTH(att_date)='".$dt[1]."' group by core_member.member_id";
            //echo $query.'<br>';
            $data = $this->db->query($query);
            $result = $data->fetchall();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $result;
        }
        
        
          public function getcontractdata($id) {
        $credt = $this->db->query("SELECT * "
                . "FROM core_member WHERE core_member.member_id= '" . $id . "'");
        $created_date = $credt->fetchArray();
        
        if ($created_date['working_year_by_year'] == NULL) {
            $date['startDate'] = $created_date['working_start_dt'];
            $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date['working_start_dt'])));
        } else {
            $date['startDate'] = $created_date['working_year_by_year'];
            $date['endDate'] = date('Y-m-d', strtotime("+1 year", strtotime($created_date['working_year_by_year'])));
            //print_r($date);exit;
        }
        //print_r($date);exit;
        return $date;
    }
}
