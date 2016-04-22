<?php

namespace salts\Manageuser\Controllers;

use salts\Manageuser\Models\User as User;
use salts\Core\Models\Db;

class IndexController extends ControllerBase {

    public $user;

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->setManageUserJsAndCss();
        $this->user = new User();
        $this->module_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->module_name);
        $this->view->permission = $this->permission;
        $this->view->t = $this->_getTranslation();
        $this->view->module_name = $this->module_name;
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
        $ModuleIdCallCore = new Db\CoreMember();
        $this->moduleIdCall = $ModuleIdCallCore->ModuleIdSetPermission($this->module_name, $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
        $this->view->setVar("Noti", $noti);
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @desc   Array ,show all user data 
     * @since  18/7/15
     * @version 3/9/2015 @by David JP
     */
    public function indexAction() {
        //for paging and edit user        
        if ($this->permission == 1) {
            $currentPage = $this->request->get('page');
            $this->assets->addJs("apps/manageuser/js/index-index.js");
            $this->assets->addJs('apps/manageuser/js/base.js');
            $getname = Db\CoreMember::getInstance()->getUserName($currentPage);
            $username = $this->request->get('username');
            $list = $this->user->userList($username, $currentPage);
            $member_count = new Db\CoreMember();
            $member_count_number = $member_count->getNumberCount();
            $this->view->member_count_number = $member_count_number;
 
            $this->view->modulename = $this->module_name;
            $this->view->setVar('username', $getname);
            $this->view->setVar('Result', $list);
        } else {
            $this->response->redirect('core/index');
        }
    }

    //for monthly list autocomplete
    public function usernameautolistAction() {
        if ($this->permission == 1) {
            $UserList = new Db\CoreMember();
            $Username = $UserList->autoUsername();
            $this->view->disable();
            echo json_encode($Username);
        } else {
            "Page Not Found";
        }
    }

    /**
     * @get data for user id
     * @return type [new || edit]
     * @author David
     * @since 20/7/15
     */
    public function manageuserAction() {
        if ($this->permission == 1) {
            $type = $this->request->get('data');
            $t = $this->_getTranslation();
            $edit = array();
            if ($type == 'new') {
                $edit[0] = $type;
                $edit[1]["add"] = $t->_("adduser");
                $edit[1]["ssn"] = $t->_("ssn_no");
                $edit[1]['bank'] = $t->_("bank");
                $edit[1]["name"] = $t->_("name");
                $edit[1]["fullname"] = $t->_("username");
                $edit[1]["pass"] = $t->_("password");
                $edit[1]["confirm"] = $t->_("confirm_pass");
                $edit[1]["dept"] = $t->_("dept");
                $edit[1]["pos"] = $t->_("position");
                $edit[1]["mail"] = $t->_("mail");
                $edit[1]["pno"] = $t->_("phone");
                $edit[1]["address"] = $t->_("address");
                $edit[1]["role"] = $t->_("user_role");
                $edit[1]["profile"] = $t->_("user_profile");
                $edit[1]["w_start_dt"] = $t->_("w_start_dt");
                $edit[1]['placeholder_ssn'] = $t->_("placeholder_ssn");
                $edit[1]['placeholder_bank'] = $t->_("placeholder_bank");
                $edit[1]["placeholder1"] = $t->_("placeholder1");
                $edit[1]["placeholder2"] = $t->_("placeholder2");
                $edit[1]["placeholder3"] = $t->_("placeholder3");
                $edit[1]["placeholder4"] = $t->_("placeholder4");
                $edit[1]["placeholder5"] = $t->_("placeholder5");
                $edit[1]["placeholder6"] = $t->_("placeholder6");
                $edit[1]["placeholder7"] = $t->_("placeholder7");
                $edit[1]["placeholder8"] = $t->_("placeholder8");
                $edit[1]["placeholder9"] = $t->_("placeholder9");
                $edit[1]["placeholder10"] = $t->_("placeholder10");
                $edit[1]["placeholder11"] = $t->_("placeholder11");
                $edit[1]["placeholder12"] = $t->_("placeholder12");
                echo json_encode($edit);
            } else {
                $res = $this->user->userEdit($type);
                $edit[0] = $res[0];
                $edit[1]["edit"] = $t->_("edit_user");

                $edit[1]["id"] = $t->_("id");
                $edit[1]["bank"] = $t->_("bank");
                $edit[1]["name"] = $t->_("name");
                $edit[1]["dept"] = $t->_("dept");
                $edit[1]["pos"] = $t->_("position");
                $edit[1]["mail"] = $t->_("mail");
                $edit[1]["pno"] = $t->_("phone");
                $edit[1]["address"] = $t->_("address");
                $edit[1]["w_start_dt"] = $t->_("w_start_dt");
                $edit[1]["btn_edit"] = $t->_("btn_edit");
                $edit[1]["btn_delete"] = $t->_("btn_delete");
                $edit[1]["btn_cancel"] = $t->_("btn_cancel");
                echo json_encode($edit);
            }
            $this->view->disable();
        } else {
            echo 'Page Not Found';
        }
    }

    /**
     * @author David
     * @type   data id
     * @desc   Delete user by id
     * @since  20/7/15
     */
    public function deleteuserAction() {

        if ($this->permission == 1) {

            $id = $this->request->get('data');
            $this->user->userDelete($id);
            $this->view->disable();
        } else {
            echo 'Page Not Found';
        }
    }

    /**
     * @type   form data
     * @desc   update user
     * @since  20/7/15
     */
    public function userdataeditAction() {
        if ($this->permission == 1) {
            $cond = array();
            $cond['id'] = $this->request->get('data');
            $cond['bank'] = $this->request->get('bank');
            $cond['name'] = $this->request->get('name');
            $cond['dept'] = $this->request->get('dept');
            $cond['position'] = $this->request->get('position');
            $cond['email'] = $this->request->get('email');
            $cond['pno'] = $this->request->get('pno');
            $cond['address'] = $this->request->get('address');
            $cond['work_sdate'] = $this->request->get('work_sdate');
            $result = $this->user->editByCond($cond);
            echo json_encode($result);             // send validating data
            $this->view->disable();
        } else {
            echo 'Page Not Found';
        }
    }

    public function adduserAction() {
        
    }

    public function getpermitAction() {
        if ($this->permission == 1) {
            $Permission = new Db\CorePermissionGroupId();
            $row = $Permission::find();
            echo json_encode($row->toArray());
            $this->view->disable();
        } else {
            echo 'Page Not Found';
        }
    }

}
