<?php

namespace salts\Document\Controllers;

use salts\Document\Models\Document;
use salts\Document\Models\CompanyInfo;
use salts\Core\Models\Db\CoreMember;
use salts\Core\Models\Db;
use salts\Document\Models\CorePermissionGroupId;

class IndexController extends ControllerBase {

    public $calendar;

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->setDocumentJsAndCss();
        $this->act_name = $this->router->getActionName();
        $this->permission = $this->setPermission($this->act_name);
        $code = $this->session->permission_code;
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];

        $this->view->permission = $this->permission;
        $ModuleIdCallCore = new Db\CoreMember();

        $this->module_name = $this->router->getModuleName();
        $this->moduleIdCall = $ModuleIdCallCore->moduleIdSetPermission($this->module_name, $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $Admin->getUserNoti($id, 1);
            }
        }

        $this->view->setVar("Noti", $Noti);
    }

    /**
     * Show ssb document
     * @author zinmon
     */
    public function ssbdocumentAction() {
        if ($this->moduleIdCall == 1) {
            $this->view->module_name = $this->router->getModuleName();
            $this->assets->addJs('apps/document/js/index-print.js');
            $SalaryDetail = new Document();
            $result = $SalaryDetail->getSsbInfo();
             $ComInfo = new CompanyInfo();
            $ComInfo = CompanyInfo::find();
            $coreid = new CorePermissionGroupId();

            if ($this->permission == 1) {
                $this->view->salary_info = $result;
                $this->view->cominfo = $ComInfo;
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * tax documentation form
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function taxdocumentAction() {
        $ModuleIdCallCore = new Db\CoreMember();
        $this->view->module_name = $this->router->getModuleName();
        $moduleIdCall = $ModuleIdCallCore->moduleIdSetPermission($this->module_name, $this->session->module);

        if ($moduleIdCall == 1) {
            $this->assets->addJs('apps/document/js/index-print.js');
            $SalaryDetail = new Document();
            $result = $SalaryDetail->getSalaryInfo();
            if ($this->permission == 1) {
                $this->view->salary_info = $result;
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * show letterhead
     */
    public function letterheadAction() {

        $ModuleIdCallCore = new Db\CoreMember();
        $this->view->module_name = $this->router->getModuleName();
        $moduleIdCall = $ModuleIdCallCore->moduleIdSetPermission($this->module_name, $this->session->module);
        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/document/js/index-letterhead.js');
            $ComInfo = new CompanyInfo();
            $ComInfo = CompanyInfo::find();
            $coreid = new CorePermissionGroupId();
            if ($this->permission == 1) {
                $this->view->setVar("info", $ComInfo);
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * Edit Company Profile
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function editinfoAction() {
        $file_name = $this->session->db_config['company_id']. '.' . end(explode(".", $_FILES["fileToUpload"]["name"]));
        $company_id=($this->session->db_config['company_id']);
         $target_dir = "uploads/$company_id./";
        if (!is_dir($target_dir)) {
         mkdir($target_dir);
       }
       
        $target_file = $target_dir . $file_name;
       
        $ComInfo = new CompanyInfo();
        $update_info = $this->request->getPost('update');
        if ($_FILES["fileToUpload"]["name"] == null) {
            $update_info['company_logo'] = $update_info['temp_logo'];
        } else {
            $pic = $update_info['temp_logo'];
             unlink("$target_dir/$pic");
              move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $update_info['company_logo'] = $file_name;
        }
        $ComInfo->editCompanyInfo($update_info);
        $this->response->redirect("document/index/letterhead");
    }

}
