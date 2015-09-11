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
        $this->assets->addCss('common/css/style.css');  
        $this->assets->addCss('apps/calendar/css/fullcalendar.min.css');  
        $this->assets->addJs('apps/calendar/js/moment.min.js');
        $this->assets->addJs('apps/calendar/js/fullcalendar.min.js');        
        $this->assets->addJs('apps/calendar/js/calendar.js');   
         $this->assets->addJs('apps/calendar/js/selectall.js');
         $this->assets->addCss('common/css/css/style.css');
    }

    
   public function indexAction() {
        $User=new Db\CoreMember;
        
       if($this->session->permission_code=="ADMIN"){
            $noti=$User->GetAdminNoti();
       }
       else{
           $id = $this->session->user['member_id'];
        $noti=$User->GetUserNoti($id);        

       }
       
        $this->view->setVar("noti",$noti);
        $GetMember=new Db\CoreMember();
        $Username = $GetMember::getinstance()->getusername();
        $this->view->uname = $Username;
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
     * @author   David
     * @category create event
     * @return   json { error message }
     */
    public function createAction() {
        $this->view->disable();
        $uname = $this->request->get('uname');
        $sdate = $this->request->get('sdate');
        $edate = $this->request->get('edate');
        $title = $this->request->get('title');
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
            $event=$this->calendar->create_event($sdate, $edate, $title,$uname);
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
    public function editAction() {
        $this->view->disable();
        $id = $this->request->get('id');
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
            $edit=$this->calendar->edit_event($name,$sdate, $edate, $title, $id);
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

