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
            $sql ="SELECT * FROM calendar where member_id IN ('$member_id')";
            }
            else{
            $sql ="SELECT * FROM calendar where id IN ('$id') or member_id IN ('$id')";
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
    public function create_event($sdate,$edate,$title,$uname){                        
         $this->db = $this->getDI()->getShared("db");
         $insert ="INSERT INTO calendar (member_id,title,startdate,enddate,allDay) Values ('".$uname."','".$title."','".$sdate."','".$edate."','true')";
         $query=  $this->db->query($insert);
         return $query;
    }
    /**
     * @desc   edit event
     * @author David
     */
    public function edit_event($name,$sdate,$edate,$title,$id){
         $this->db = $this->getDI()->getShared("db");
         $update ="UPDATE calendar SET member_id ='".$name."',title ='".$title."',startdate='".$sdate."',enddate='".$edate."' WHERE id='".$id."'";
         $query=  $this->db->query($update);
         return $query;
    }
    public function getid_name($id){
        $this->db = $this->getDI()->getShared("db");
        $getname = "Select member_id from calendar where id='".$id."'";
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
}
