<?php

namespace workManagiment\Calendar\Controllers;
use workManagiment\Core\Models\Db;
class IndexController extends ControllerBase
{
    public $calendar;
    public function initialize() {
        parent::initialize();  
        $this->calendar = new \workManagiment\Calendar\Models\Calendar();
        $this->setCommonJsAndCss();
        $this->assets->addCss('apps/calendar/css/calendar.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('apps/calendar/css/fullcalendar.min.css');  
        $this->assets->addJs('apps/calendar/js/moment.min.js');
        $this->assets->addJs('apps/calendar/js/fullcalendar.min.js');
        $this->assets->addJs('apps/calendar/js/calendar.js');   
        $this->assets->addJs('apps/calendar/js/selectall.js');
        $this->assets->addCss('common/css/css/style.css');
        $this->module_name =  $this->router->getModuleName();
        $this->permission = $this->setPermission();
        $this->view->t = $this->_getTranslation();
    }

    
   public function indexAction() {
        $User=new Db\CoreMember;
        $id = $this->session->user['member_id'];
       if($this->session->permission_code=="ADMIN"){
        $noti=$User->GetAdminNoti($id);
       }
       else{                      
        $noti=$User->GetUserNoti($id);     
       }       
        $this->view->setVar("noti",$noti);
        $GetMember=new Db\CoreMember();
        $permitname = $this->calendar->getalluser($id);
        $Allname   = $GetMember::getinstance()->getusername();                
        $this->view->event_name = $permitname;
        $this->view->member_name=$this->session->user['member_login_name'];
        $this->view->uname = $Allname;
        $this->view->modulename = $this->module_name;
    }
    
    public function getmemberAction() {        
      $MemberList=new Db\CoreMember();
        $Username = $MemberList->userautolistusername(); 
        $this->view->disable();    
        echo json_encode($Username);
    }
    
    //calender auto complete  for username
    public function calenderautoAction() {
        $UserList = new Db\CoreMember();
        $Username = $UserList->autousername();
        //print_r($Username);exit;
        $this->view->disable();
        echo json_encode($Username);
    }
    
    public function addmemberAction(){
        $permit_name = $this->request->get("permit");
        $id = $this->session->user['member_id'];
        $data = $this->calendar->add_permit_name($permit_name,$id);
        echo json_encode($data);
        $this->view->disable();
    }
    
    public function removeEventBynameAction() {
        $remove = $this->request->getPost('remove');
        $id = $this->session->user['member_id'];
        $data = $this->calendar->remove_member($remove,$id); 
        echo json_encode($data);
        $this->view->disable(); 
    }
    /**
     * @desc calendar event show
     * @author david
     * @since 27/7/15
     */

    public function showdataAction() {   
        $id = $this->request->get('event_id');
        $this->view->disable();
        $events = $this->calendar->fetch($id);
        echo json_encode($events);
    }
    /**
     * @author David JP <david.gnext@gmail.com>
     * @category create event
     * @return   json { error message }
     */
    public function createAction($id) {        
        $this->view->disable();        
        $uname = $this->request->get('uname');
        $sdate = $this->request->get('sdate');
        $edate = $this->request->get('edate');
        $title = $this->request->get('title');
        $creator_id=$this->session->user['member_id'];
        $res= array();
        if ($title == null ) {
            $res['cond']=FALSE;
            $res['title']="Title not be empty";
        }
        else if($uname == null){
            $res['cond'] = FALSE;
            $res['name']= "Name must be insert";
        }
        else if(strtotime($sdate)>strtotime($edate)){
            $res['cond']=FALSE;
            $res['date']="End date must be greater than start date";
        }
        else {            
            $res['cond']=TRUE;
            $event=$this->calendar->create_event($creator_id,$id,$sdate, $edate, $title,$uname);
            $res['res']=  $event;
            $res['name']= $uname;
        }
        echo json_encode($res);
    }
    /**
     * @author   David
     * @category edit event
     * @return   json { error message }
     */
    public function editAction($id,$member_id) {        
        $this->view->disable();        
        $sdate = $this->request->get('sdate');
        $edate = $this->request->get('edate');
        $name = $this->request->get('uname');
        $title = $this->request->get('title');        
         $res= array();
        if ($title == null) {            
            $res['cond']=FALSE;
            $res['res']="title not be empty";            
        }
        else if(strtotime($sdate)>strtotime($edate)){
            $res['cond']=FALSE;
            $res['date']="End date must be greater than start date";
        }
        else {            
            $res['cond']=TRUE;
            $edit=$this->calendar->edit_event($name,$sdate, $edate, $title, $id,$member_id);
            $res['res']=$edit;
            $res['name']=$name;
        }
        echo json_encode($res);       
    }
    /**
     * @desc Delete event
     * @author David
     * @since 27/7/15
     */
    public function deleteAction() {
        $this->view->disable();
        $id = $this->request->get('data');        
        $this->calendar->delete_event($id);
    }
    public function getidAction(){
        $this->view->disable();
        $id = $this->request->get('id');
        $result=$this->calendar->getid_name($id);
        echo json_encode($result);
    }
     
}

