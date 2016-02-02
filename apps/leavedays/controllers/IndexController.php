<?php

namespace salts\Leavedays\Controllers;

use salts\Core\Models\Db;
use salts\Leavedays\Models\Leaves as Leave;
use salts\Leavedays\Models\LeaveCategories as LeaveCategories;
use salts\Leavedays\Models\LeavesSetting as LeavesSetting;

class IndexController extends ControllerBase {

    public $_leave;
    public $config;

    public function initialize() {
        $this->config = \Module_Config::getModuleConfig('leavedays'); // get config data,@type module name
        $this->_leave = new Leave();
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('apps/leavedays/js/index-leavesetting.js');
        $Admin = new Db\CoreMember();
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {

                $noti = $Admin->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {

                $noti = $Admin->GetUserNoti($id, 1);
            }
        }

        $this->view->setVar("noti", $noti);
        $this->view->module_name = $this->router->getModuleName();
        $this->view->t = $this->_getTranslation();
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
        $this->view->permission = $this->permission;
        $moduleIdCallCore = new Db\CoreMember();
        $this->module_name = $this->router->getModuleName();
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->module_name, $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
    }

    public function indexAction() {
        
    }

    public function autolistAction() {


        if ($this->moduleIdCall == 1) {
            $UserList = new Db\CoreMember();
            $Username = $UserList->autousername();
            $this->view->disable();
            echo json_encode($Username);
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * get member id
     */
    public function getapplymemberidAction() {
        $data = $this->request->get('username');

        $leavetype = new LeaveCategories();
        $cond = $leavetype->memidapplyleave($data);
        echo json_encode($cond);
        $this->view->disable();
    }

    /**
     * @author David
     * @type   $id,$sdate,$edate,$type,$desc
     * @desc   Apply Leave Action
     */
    public function applyleaveAction() {


        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/leavedays/js/applyleave.js');
            $this->assets->addJs('common/js/jquery-ui-timepicker.js');
            $this->assets->addCss('common/css/jquery-ui-timepicker.css');
            $leavetype = new LeaveCategories();
            $ltype = $leavetype->getleavetype();
            $userlist = new Db\CoreMember();

            $name = $userlist::getinstance()->getusername();

            if ($this->permission == 1) {
                $this->view->setVar("name", $name);
                $this->view->setVar("Leavetype", $ltype);
                $this->view->modulename = $this->module_name;
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
    }

    public function checkapplyAction() {
        if ($this->request->isPost()) {
            $user = $this->_leave;
            $validate = $user->validation($this->request->getPost());

            if (count($validate)) {
                foreach ($validate as $message) {
                    $json[$message->getField()] = $message->getMessage();
                }
                $json['result'] = "error";
                echo json_encode($json);
                $this->view->disable();
            } else {
                $creator_id = $this->session->user['member_id'];
                $uname = $this->request->getPost('member_id');
                $sdate = $this->request->getPost('sdate');
                $edate = $this->request->getPost('edate');
                $type = $this->request->getPost('leavetype');
                $desc = $this->request->getPost('description');
                $error = $this->_leave->applyleave($uname, $sdate, $edate, $type, $desc, $creator_id);
                echo json_encode($error);
                $this->view->disable();
            }
        }
    }

    /**
     * Show Leave data list
     */
    public function leavelistAction(){  
        
          
       if ($this->moduleIdCall == 0)
       {
            
          $this->act_name =  $this->router->getModuleName(); 
        $this->permission = $this->setPermission($this->act_name ); 
        $Admin=new Db\CoreMember;
        $id=$this->session->user['member_id'];
        $noti=$Admin->GetAdminNoti($id,0);
        $this->view->setVar("noti",$noti);
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/leavedays/js/search.js');
        $this->assets->addJs('apps/leavedays/js/leavelist.js');
        $month = $this->config['month'];
        $leavetype = new LeaveCategories();
        $ltype = $leavetype->getleavetype();
        $this->view->setVar("Leavetype", $ltype);
        $UserList = new Db\CoreMember();
        $GetUsername = $UserList::getinstance()->getusername();
        $leaves = $this->_leave->getleavelist();
        $absent = $this->_leave->getabsent();
        $max=$this->_leave->getleavesetting();
        $max_leavedays=$max['0']['max_leavedays'];
          if($this->permission==1){
        $this->view->max = $max_leavedays;
        $this->view->Getname = $GetUsername;
        $this->view->setVar("Result", $leaves);
        $this->view->setVar("absent",$absent);
        $this->view->setVar("Month", $month);
        $this->view->modulename = $this->module_name;
        }
        else {
            $this->response->redirect('core/index');
        }
    }
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Leave Setting
     * to edit leave categories and max leave day
     */
    public function leavesettingAction() {


        if ($this->moduleIdCall == 1) {

            $this->act_name = $this->router->getModuleName();
            $this->permission = $this->setPermission($this->act_name);
            $Admin = new Db\CoreMember;
            $id = $this->session->user['member_id'];
            $noti = $Admin->GetAdminNoti($id);
            $this->view->setVar("noti", $noti);
            $LeaveCategories = new LeaveCategories();
            $LeaveSetting = new LeavesSetting();
            $typelist = $LeaveCategories->getleavetype();
            $setting = $LeaveSetting->getleavesetting();
            if ($this->permission == 1) {
                $this->view->modulename = $this->module_name;
                $this->view->setVar("leave_typelist", $typelist);
                $this->view->setVar("leave_setting", $setting);
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * adding leave categories dialog box
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function ltyaddAction() {
        $t = $this->_getTranslation();
        $data[1]['addleavetype'] = $t->_("addleavetype");
        $data[1]['leave_category'] = $t->_("leave_category");
        $data[1]['yes'] = $t->_("yes");
        $data[1]['no'] = $t->_("cancel");
        $data[1]['enterltp'] = $t->_("enterltp");
        $this->view->disable();
        echo json_encode($data);
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Edit Leave categories with dialog
     */
    public function ltypediaAction() {
        $id = $this->request->get('id');
        $t = $this->_getTranslation();
        $LeaveCategories = new LeaveCategories();
        $data = $LeaveCategories->getltypedata($id);
        $data[1]['delete_confirm'] = $t->_("deleteleavetype");
        $data[1]['yes'] = $t->_("yes");
        $data[1]['no'] = $t->_("cancel");
        $this->view->disable();
        echo json_encode($data);
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Deleting leave categories in leave setting
     */
    public function delete_ltypeAction() {
        $leavetype_id = $this->request->getPost('id');
        $LeaveCategories = new LeaveCategories();
        $LeaveCategories->delete_categories($leavetype_id);
        $this->view->disable();
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Adding new leave categories in leave setting
     */
    public function add_ltypeAction() {
        $leavetype_name = $this->request->getPost('ltype_name');
        $LeaveCategories = new LeaveCategories();
        $LeaveCategories->add_newcategories($leavetype_name);
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * editting the setting of leave
     * max leavedays/leave categories
     */
    public function editleavesettingAction() {
        $max_leavedays = $this->request->getPost('max_leavedays');
        $LeaveSetting = new LeavesSetting();
        $LeaveSetting->editleavesetting($max_leavedays);
        $this->response->redirect('leavedays/index/leavesetting');
    }

    /**
     * @author Su Zin Kyaw<gnext.suzin@gmail.com>
     * Admin Accepting the leave request
     */
    public function acceptleaveAction() {
        $id = $this->request->get('id');
        $days = $this->request->getPost('leave_days');
        $noti_id = $this->request->getPost('noti_id');

        $this->_leave->acceptleave($id, $days, $noti_id);
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Admin rejecting the leave request
     */
    public function rejectleaveAction() {
        $noti_id = $this->request->getPost('noti_id');
        $this->_leave->rejectleave($noti_id);
    }

    /**
     * auto complete username when apply leave
     * @author Saw Zin Min Htun 
     */
    public function applyautolistAction() {
        $UserList = new Db\CoreMember();
        $Username = $UserList->applyautousername();
        $this->view->disable();
        echo json_encode($Username);
    }

    /**
     * @author Saw Zin Min Tun
     * @type   
     * @desc   No Leave Action
     */
    public function noleavelistAction() {
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/leavedays/js/leavepaging.js');
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti = $Admin->GetAdminNoti($id);
        $this->view->setVar("noti", $noti);

        $Result = $Admin->checkleave();

        $this->view->setVar("Result", $Result);
    }

    /**
     * @author Saw Zin Min Tun
     * @type   
     * @desc  Leave Most Action
     */
    public function leavemostAction() {
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/leavedays/js/leavepaging.js');
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti = $Admin->GetAdminNoti($id);
        $this->view->setVar("noti", $noti);

        $Result = $Admin->leavemost();

        $this->view->setVar("Result", $Result);
    }

}
