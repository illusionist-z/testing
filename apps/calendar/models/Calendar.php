<?php
namespace workManagiment\Calendar\Models;
use Phalcon\Mvc\Model;
/**
 * @author David
 * @since 27/7/2015
 * @desc  To create,edit,delete event
 */
class Calendar extends Model {
     public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }
    /**
     * @return array {calendar event data}
     * @author David
     * @desc   Select all data 
     */
    public function fetch($id) {                    
            $events = array();                        
            if(is_array($id)){
            $member_id = implode($id,"','");
            $sql ="SELECT * FROM calendar where member_name IN ('$member_id')";            
            }
            else{                
            $sql ="SELECT * FROM calendar where id IN ('$id') or member_name IN ('$id')";
            }
            $query=  $this->db->query($sql);
            $query->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
          while ($fetch = $query->fetchArray()) {                      
                $e = array();
                $e['id'] = $fetch['id'];
                $e['title'] = $fetch['title'];
                $e['start'] = $fetch['startdate'];
                $e['end'] = $fetch['enddate'];
                $allday = ($fetch['allDay'] == "true") ? true : false;
                $e['allDay'] = $allday;                
                array_push($events, $e);
            }            
            return $events;
    }
    /**
     * @desc create new event by click on calendar
     * @author David
     */
    public function create_event($id,$sdate,$edate,$title,$uname){                        
         $this->db = $this->getDI()->getShared("db");
         $insert ="INSERT INTO calendar (member_name,member_id,title,startdate,enddate,allDay) Values ('".$uname."','".$id."','".$title."','".$sdate."','".$edate."','true')";
         $query=  $this->db->query($insert);
         return $query;
    }
    /**
     * @desc   edit event
     * @author David
     */
    public function edit_event($name,$sdate,$edate,$title,$id,$member_id){
         $this->db = $this->getDI()->getShared("db");
         $update ="UPDATE calendar SET member_name ='".$name."',title ='".$title."',startdate='".$sdate."',enddate='".$edate."',member_id ='".$member_id."' WHERE id='".$id."'";
         $query=  $this->db->query($update);
         return $query;
    }
    public function getid_name($id){
        $this->db = $this->getDI()->getShared("db");
        $getname = "Select member_name from calendar where id='".$id."'";
        $query = $this->db->query($getname);
        $result=$query->fetchall();
        return $result;
    }
    /**    
     * @since 27/7/15
     * @author David
     */     
    public function delete_event($id) {                
        $this->db=  $this->getDI()->getShared("db");
        $delete="DELETE FROM calendar WHERE id='".$id."'";
        $query=  $this->db->query($delete);
        return $query;
    }
    
    public function remove_member($remove_id,$id){        
        $remove_id = implode($remove_id,"','");                
        $query = "update member_event_permission set delete_flag =1 where permit_name IN ('$remove_id') and member_name = '".$id."'";
        $this->db->query($query);                             
    }
   /**
    * @author David JP <david.gnext@gmail.com>
    * @param type $permit_name
    * @param type $id    
    * @desc    event permit action
    */
    public function add_permit_name($permit_name,$id) {
        $query = "Select * from member_event_permission where permit_name ='".$permit_name."' and member_name = '".$id."' ";
        $result = $this->db->query($query);                
        if($result->numRows() == 0){                        
            $query1 = "Insert into member_event_permission (member_name,permit_name,delete_flag) Values ('".$id."','".$permit_name."',0)";
            $this->db->query($query1);            
            $return  = 0;
        }
        else{            
            $query2 = "Select * from member_event_permission where permit_name ='".$permit_name."' and member_name = '".$id."' and delete_flag=1";
            $result2 = $this->db->query($query2);
                if($result2->numRows() == 0){
                $return = 1;
                }
                else{
                    $query3 = "update member_event_permission set delete_flag = 0 where permit_name = '".$permit_name."' and member_name = '".$id."'";
                    $this->db->query($query3);
                $return = 0;
                }
        }
        return $return;
    }
    public function getalluser($id){
        $query = "Select member_name ,permit_name from member_event_permission where member_name ='".$id."' and delete_flag=0";
        $result = $this->db->query($query);
        $data = $result->fetchall();
        return $data;
    }
}
