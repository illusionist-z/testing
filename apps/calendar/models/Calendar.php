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
    public function fetch() {                    
            $events = array();
            $sql ="SELECT * FROM calendar";
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
    public function create_event($sdate,$edate,$title){                        
         $this->db = $this->getDI()->getShared("db");
         $insert ="INSERT INTO calendar (title,startdate,enddate,allDay) Values ('".$title."','".$sdate."','".$edate."','true')";
         $query=  $this->db->query($insert);
         return $query;
    }
    /**
     * @desc   edit event
     * @author David
     */
    public function edit_event($sdate,$edate,$title,$id){
         $this->db = $this->getDI()->getShared("db");
         $update ="UPDATE calendar SET title ='".$title."',startdate='".$sdate."',enddate='".$edate."' WHERE id='".$id."'";
         $query=  $this->db->query($update);
         return $query;
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
