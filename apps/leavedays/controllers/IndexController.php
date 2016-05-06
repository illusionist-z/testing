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
        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays'); // get config data,@type module name
        $this->_leave = new Leave();
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->setLeaveJsAndCss();
        $Admin = new Db\CoreMember();
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $noti = $Admin->GetAdminNoti($this->session->user['member_id'], 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $Admin->GetUserNoti($this->session->user['member_id'], 1);
            }
        }
        $this->view->setVar("Noti", $noti);
        $this->view->module_name = $this->router->getModuleName();
        $this->view->t = $this->_getTranslation();
        $this->permission = $this->setPermission($this->router->getModuleName());
        $this->view->permission = $this->permission;
        $moduleIdCallCore = new Db\CoreMember();
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->router->getModuleName(), $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
    }

    public function indexAction() {
        $this->response->redirect('core/index');
    }

    public function autolistAction() {
        if ($this->moduleIdCall == 1) {
            $UserList = new Db\CoreMember();
            $this->view->disable();
            echo json_encode( $UserList->autoUsername());
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * get member id
     */
    public function getapplymemberidAction() {
        if ($this->permission == 1) {
            $LeaveType = new LeaveCategories();
            $cond = $LeaveType->memberIdApplyLeave($this->request->get('username'));
            echo json_encode($cond);
            $this->view->disable();
        } else {
            echo 'Page Not Found';
        }
    }

    /**
     * @author David
     * @type   $id,$sdate,$edate,$type,$desc
     * @desc   Apply Leave Action
     */
    public function applyleaveAction() {
        if ($this->moduleIdCall == 1) {
            $LeaveType = new LeaveCategories();
            $UserList = new Db\CoreMember();
            $name = $UserList::getinstance()->getusername();
            if ($this->permission == 1) {
                $this->view->setVar("name", $name);
                $this->view->setVar("Leavetype", $LeaveType->getLeaveType());
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
            $validate = $this->_leave->validating($this->request->getPost());
            if (count($validate)) {
                foreach ($validate as $message) {
                    $json[$message->getField()] = $message->getMessage();
                }
                $json['result'] = "error";
                echo json_encode($json);
            } else {
                echo json_encode($this->_leave->applyLeave($this->request->getPost('member_id'), $this->request->getPost('sdate'), $this->request->getPost('edate'), $this->request->getPost('leavetype'), $this->request->getPost('description'), $this->session->user['member_id']));
            }
            $this->view->disable();
        }
    }

    /**
     * Show Leave data list
     */
    public function leavelistAction($exportMode = null) {
        if ($this->moduleIdCall == 1) {
            $this->permission = $this->setPermission($this->router->getModuleName());
            $Admin = new Db\CoreMember;
            $this->view->setVar("noti", $Admin->GetAdminNoti($this->session->user['member_id'], 0));
            $LeaveType = new LeaveCategories();
            $this->view->setVar("Leavetype", $LeaveType->getLeaveType());
            $UserList = new Db\CoreMember();
            $page = $this->request->get("page");
            $max = $this->_leave->getLeaveSetting();
            if ($this->permission == 1) {
                if(1 == $exportMode){
                $result = $this->_leave->getLeaveList($page,0);
                $this->_leave->exportUserLeaveList($result,"UserLeaveListAll",  $this->_leave->getAbsent(),$max['0']['max_leavedays']);
                }
                else{
                $this->view->max = $max['0']['max_leavedays'];
                $this->view->Getname = $UserList::getinstance()->getusername();
                $this->view->setVar("Result", $this->_leave->getLeaveList($page,1));
                $this->view->setVar("absent", $this->_leave->getAbsent());
                $this->view->setVar("Month", $this->config['config']['month']);
                }
                //$this->view->modulename = $this->module_name;
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Leave Setting
     * to edit leave categories and max leave day
     */
    public function leavesettingAction() {
        if ($this->moduleIdCall == 1) {
            $this->permission = $this->setPermission($this->router->getModuleName());
            $Admin = new Db\CoreMember;
            $this->view->setVar("Noti", $Admin->GetAdminNoti($this->session->user['member_id'], 0));
            $LeaveCategories = new LeaveCategories();
            $LeaveSetting = new LeavesSetting();
            if ($this->permission == 1) {
                $this->view->modulename = $this->module_name;
                $this->view->setVar("leave_typelist", $LeaveCategories->getLeaveType());
                $this->view->setVar("leave_setting", $LeaveSetting->getLeaveSetting());
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
        if ($this->permission == 1) {
            $t = $this->_getTranslation();
            $data[1]['addleavetype'] = $t->_("addleavetype");
            $data[1]['leave_category'] = $t->_("leave_category");
            $data[1]['yes'] = $t->_("yes");
            $data[1]['no'] = $t->_("cancel");
            $data[1]['enterltp'] = $t->_("enterltp");
            $this->view->disable();
            echo json_encode($data);
        } else {
            echo 'Page Not Found';
        }
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Edit Leave categories with dialog
     */
    public function ltypediaAction() {
        $t = $this->_getTranslation();
        $LeaveCategories = new LeaveCategories();
        $data[0] = $LeaveCategories->getListTypeData($this->request->get('id'));
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
    public function deleteListTypeAction() {
        $leavetype_id = $this->request->getPost('id');
        $LeaveCategories = new LeaveCategories();
        $LeaveCategories->deleteCategories($leavetype_id);
        $this->view->disable();
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Adding new leave categories in leave setting
     */
    public function addListTypeAction() {
        if ($this->permission == 1) {
            $LeaveCategories = new LeaveCategories();
            $LeaveCategories->addNewCategories($this->request->getPost('ltype_name'));
        } else {
            echo 'Page Not Found';
        }
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * editting the setting of leave
     * max leavedays/leave categories
     */
    public function editleavesettingAction() {
        $LeaveSetting = new LeavesSetting();
        $LeaveSetting->editLeaveSetting($this->request->getPost('max_leavedays'));
        $this->response->redirect('leavedays/index/leavesetting');
    }

    /**
     * @author Su Zin Kyaw<gnext.suzin@gmail.com>
     * Admin Accepting the leave request
     */
    public function acceptleaveAction() {
        if ($this->permission == 1) {
            $this->_leave->acceptLeave($this->request->get('id'), $this->request->getPost('leave_days'), $this->request->getPost('noti_id'));
        } else {
            echo 'Page Not Found';
        }
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Admin rejecting the leave request
     */
    public function rejectleaveAction() {
        if ($this->permission == 1) {
            $this->_leave->rejectLeave($this->request->getPost('noti_id'));
        } else {
            echo 'Page Not Found';
        }
    }

//    /**
//     * auto complete username when apply leave
//     * @author Saw Zin Min Htun 
//     */
//    public function applyautolistAction() {
//        if ($this->permission == 1) {
//            $UserList = new Db\CoreMember();
//            $Username = $UserList->applyautousername();
//            $this->view->disable();
//            echo json_encode($Username);
//        } else {
//            echo 'Page Not Found';
//        }
//    }

    /**
     * @author Saw Zin Min Tun
     * @type   
     * @desc   No Leave Action
     */
    public function noleavelistAction() {
        if ($this->permission == 1) {
            $this->assets->addJs('common/js/paging.js');
            $this->assets->addJs('apps/leavedays/js/index-paging.js');
            $Admin = new Db\CoreMember;
            $id = $this->session->user['member_id'];
            $noti = $Admin->GetAdminNoti($id);
            $this->view->setVar("Noti", $noti);
            $Result = $Admin->checkLeave();
            $this->view->setVar("Result", $Result);
        } else {
            echo 'Page Not Found';
        }
    }

    /**
     * @author Saw Zin Min Tun
     * @type   
     * @desc  Leave Most Action
     */
    public function leavemostAction() {
        if ($this->permission == 1) {
            $this->assets->addJs('common/js/paging.js');
            $this->assets->addJs('apps/leavedays/js/index-paging.js');
            $Admin = new Db\CoreMember;
            $id = $this->session->user['member_id'];
            $noti = $Admin->GetAdminNoti($id);
            $this->view->setVar("Noti", $noti);
            $Result = $Admin->leaveMost();
            $this->view->setVar("Result", $Result);
        } else {
            echo 'Page Not Found';
        }
    }

    public function detailAction() {
        if ($this->permission == 1) {
            $this->setCommonJsAndCss();
            $this->assets->addCss('common/css/css/style.css');
            $Admin = new Db\CoreMember();
            $id = $this->session->user['member_id'];
            foreach ($this->session->auth as $key_name => $key_value) {
                if ($key_name == 'show_admin_notification') {
                    $Noti = $Admin->getAdminNoti($id, 0);
                }
                if ($key_name == 'show_user_notification') {
                    $Noti = $Admin->getUserNoti($id, 1);
                }
            }
            $this->view->setVar("Noti", $Noti);
            $this->view->setVar("type", "detail");
            $Noti_detail = new Leave();
            $this->view->setVar("module_name", $this->request->get('mname'));
            $this->view->setVar("result", $Noti_detail->getNotiInfo($this->request->get('mname'), $this->request->get('id')));
            $this->view->t = $this->_getTranslation();
        } else {
            echo 'Page Not Found';
        }
    }

}
