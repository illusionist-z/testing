<?php 

namespace salts\Attendancelist\Controllers;
use salts\Auth\Models\CoreMember;

class IndexController extends ControllerBase {
    
    public $config;
    
    public function initialize() {        
        parent::initialize();
         
        $this->setCommonJsAndCss();
        $this->setAttJsAndCss();
        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays');
        $CoreMember = new \salts\Core\Models\Db\CoreMember();
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {

                $noti = $CoreMember->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {

                $noti = $CoreMember->GetUserNoti($id, 1);
            }
        }

        $this->view->setVar("Noti", $noti);
        $this->act_name = $this->router->getActionName();
        $this->view->t = $this->_getTranslation();
        $this->module_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->module_name);
        $this->view->module_name = $this->module_name;
        //$this->view->permission = $this->permission;        
        $this->moduleIdCall = $CoreMember->ModuleIdSetPermission($this->module_name, $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
        
    }
  public function indexAction() {
            $this->response->redirect('core/index');
    }
    /**
     * show today attendance list
     */
    public function todaylistAction() {
      
        if ($this->moduleIdCall == 1) {
            $this->act_name = $this->router->getModuleName();
            $currentPage = $this->request->get('page');
            $this->permission = $this->setPermission($this->act_name);
            $this->assets->addJs('common/js/jquery-ui-timepicker.js');
            $this->assets->addCss('common/css/jquery-ui-timepicker.css');
            //$id = $this->session->user['member_id'];
            $name = $this->request->get('namelist');
            $offset = $this->session->location['offset'];                       
            $AttList = new \salts\Attendancelist\Models\Attendances();
            
            if ($this->permission == 1) {
                $Result_Attlist = $AttList->getTodayList($name, $currentPage,1);
                $this->view->attlist = $Result_Attlist;
                $this->view->offset = $offset;                
                $this->view->modulename = $this->module_name;                
            }
        }
    }

    public function editTimedialogAction($id) {
         if ($this->moduleIdCall == 1) {
        $Att = new \salts\Attendancelist\Models\Attendances();
        $t = $this->_getTranslation(); //for translate
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
         else {
             echo "Page Not Found";
         }
    }

    /**
     * 
     * @param type $id
     * @param type $localtime
     * edit attendance time 
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function editTimeAction($id, $localtime) {
 if ($this->moduleIdCall == 1) {
   
        $offset = $this->session->location['offset'];
        $post = $localtime;
        $Att = new \salts\Attendancelist\Models\Attendances();
        $Att->editAtt($post, $id, $offset);
        $this->response->redirect('attendancelist/index/todaylist');
//        $this->view->disable();
    }
    else {
        echo 'Page Not Found';
    }
    }
    

    /**
     * show monthly attendancelist
     * 
     */
    public function monthlylistAction() {
        if ($this->moduleIdCall == 1) {
            $offset = $this->session->location['offset'];
            $currentPage = $this->request->get("page");
            //$month = $this->config->month['month'];
            $Attendances = new \salts\Attendancelist\Models\Attendances();

            if ($this->permission == 1) {              
                $monthly_list = $Attendances->showAttList($currentPage,1);
                $this->view->monthlylist = $monthly_list;
                $this->view->setVar("Month", $month);                
                $this->view->setVar("offset", $offset);                
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
    }

    public function attsearchAction() {
         if ($this->moduleIdCall == 1) {
            $month = $this->request->get('month');
            $username = $this->request->get('username', "string");
            $year = $this->request->get('year');
            $page = $this->request->get('page');
            $Attendances = new \salts\Attendancelist\Models\Attendances();
            $result = $Attendances->searchAttList($year, $month, $username,$page,1);
            $this->view->disable();
            echo json_encode($result);
         }
         else {
             echo 'Page Not Found';
         }
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * monthly attendance table show
     */
    public function attendancechartAction() {
         if ($this->moduleIdCall == 1) {
        $Attendances = new \salts\Attendancelist\Models\Attendances();
        $currentPage = $this->request->get("page");
        $data = $Attendances->currentAttList($currentPage);
        $this->view->data = $data;
         }
         else {
             echo 'Page Not Found';
         }
    }

    public function autolistAction() {
         if ($this->moduleIdCall == 1) {
        $UserList = new \salts\Auth\Models\Db\CoreMember();
        $Username = $UserList->autoUsername();
        $this->view->disable();
        echo json_encode($Username);
    }
  
    else {
    echo 'Page Not Found';
    }
  }
  
  
}
