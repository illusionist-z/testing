<?php

namespace salts\Attendancelist\Controllers;
use salts\Core\Models\Db;
use salts\Attendancelist\Models\CorePermissionGroupId;
class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('common/js/export.js');        
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('apps/attendancelist/js/index.js');
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
             
             if ($key_name == 'show_admin_notification') {
                //Go to user dashboard
              $noti=$Admin->GetAdminNoti($id,0);
              
              //$readnoti=$Admin->GetLastNoti($id);
                 
            } 
            if ($key_name == 'show_user_notification') {
                //Go to admin dashboard
                
               $noti=$Admin->GetUserNoti($id,1); 
            }
        }
        $this->view->setVar("noti", $noti);
        $this->act_name =  $this->router->getActionName(); 
        $this->view->t = $this->_getTranslation();
        $this->module_name =  $this->router->getModuleName();    
        $this->permission = $this->setPermission($this->module_name); 
        $this->view->module_name=$this->module_name;
        $this->view->permission = $this->permission;
        $moduleIdCallCore =new Db\CoreMember();
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->module_name,$this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
    }
    
    
    
    
    
    /**
     * show today attendance list
     */
    public function todaylistAction( ) {
       
        
       if ($this->moduleIdCall == 1)
       {
            
        $this->act_name =  $this->router->getModuleName(); 
        $this->permission = $this->setPermission($this->act_name); 
        $this->assets->addJs('common/js/jquery-ui-timepicker.js');        
        $this->assets->addCss('common/css/jquery-ui-timepicker.css');        
        $id=$this->session->user['member_id'];        
        $name = $this->request->get('namelist');
        $offset = $this->session->location['offset'];
        $UserList = new Db\CoreMember();
        $Username = $UserList::getinstance()->getusername();
        $AttList = new \salts\Attendancelist\Models\Attendances();
        $ResultAttlist = $AttList->gettodaylist($name);
       // var_dump($ResultAttlist);exit;
        if($this->permission==1){
        $this->view->attlist=$ResultAttlist;
        $this->view->offset= $offset;
        $this->view->uname = $Username;       
        //$this->view->modulename = $this->module_name;        
        }
        else {
            $this->response->redirect('core/index');
        }   
        
         }
       else {
            $this->response->redirect('core/index');
       }
       
    }        
   
    public function editTimedialogAction($id){
        //echo $id;exit;
        $Att  = new \salts\Attendancelist\Models\Attendances();
        $t = $this->_getTranslation();//for translate
        $data = $Att->getAttTime($id);
        $data[1]['attlist'] = $t->_("attendancelist");
        $data[1]['edit_att'] = $t->_("edit_att_list");
        $data[1]['name'] = $t->_("username");
        $data[1]['note'] = $t->_("note");
        $data[1]['att_time'] = $t->_("att_time");
        $data[1]['save'] = $t->_("save");
        $data[1]['cancel'] = $t->_("cancel");
        echo json_encode($data);
        $this->view->disable();
    }

    /**
     * 
     * @param type $id
     * @param type $localtime
     * edit attendance time 
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function editTimeAction($id, $localtime) {

        $offset = $this->session->location['offset'];
        $post = $localtime;
        $Att = new \salts\Attendancelist\Models\Attendances();
        $Att->editAtt($post, $id, $offset);
        $this->response->redirect('attendancelist/index/todaylist');
//        $this->view->disable();
    }

    /**
     * show monthly attendancelist
     * 
     */
    public function monthlylistAction() {    
         
         
       if ($this->moduleIdCall == 1)
       {

        
        $offset = $this->session->location['offset'];
        $UserList = new Db\CoreMember();
        $UserName = $UserList::getinstance()->getusername();
        $month = $this->config->month;
        $Attendances = new \salts\Attendancelist\Models\Attendances();
        $monthlylist = $Attendances->showattlist();
        $coreid = new CorePermissionGroupId();
         if($this->permission==1){
        $this->view->monthlylist = $monthlylist;
        $this->view->setVar("Month", $month);
        $this->view->setVar("Getname", $UserName);
        $this->view->setVar("offset", $offset);
       
        }
        else {
            $this->response->redirect('core/index');
        }  
        
        
        
           }
       else {
            $this->response->redirect('core/index');
       }
       
    }
    
    
     public function attsearchAction() {
            if ($this->request->isAjax() == true) {
                $month = $this->request->get('month');
                $username = $this->request->get('username',"string");
                $year = $this->request->get('year');                
                $Attendances = new \salts\Attendancelist\Models\Attendances();
                $result = $Attendances->search_attlist($year, $month, $username);
              
                $this->view->disable();
                echo json_encode($result);
            }        
    }
    /**
     * @author David JP <david.gnext@gmail.com>
     * monthly attendance table show
     */
    public function attendancechartAction() {
        $Attendances = new \salts\Attendancelist\Models\Attendances();
        $data = $Attendances->current_attlist();
        $this->view->data = $data;
    }

    public function autolistAction() {
        $UserList = new Db\CoreMember();
        $Username = $UserList->autousername();
        $this->view->disable();
        echo json_encode($Username);
    }

    

}
