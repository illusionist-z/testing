<?php

namespace salts\Document\Controllers;

use salts\Document\Models\Document;
use salts\Document\Models\CompanyInfo;
use salts\Core\Models\Db\CoreMember;
use salts\Core\Models\Db;

class IndexController extends ControllerBase {

    public $calendar;

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->setDocumentJsAndCss();
        $this->act_name = $this->router->getActionName();
        $this->permission = $this->setPermission($this->act_name);
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];
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

    public function indexAction() {
        $this->response->redirect('core/index');
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
            //$ComInfo = new CompanyInfo();
            $ComInfo = CompanyInfo::find();
            //$coreid = new CorePermissionGroupId();

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
        //$ModuleIdCallCore = new Db\CoreMember();
        if ($this->moduleIdCall == 1) {
            $this->assets->addCss('apps/document/css/index_tax.css');

            $this->view->module_name = $this->router->getModuleName();
            //$moduleIdCall = $ModuleIdCallCore->moduleIdSetPermission($this->module_name, $this->session->module);


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
        if ($this->moduleIdCall == 1) {
            $this->view->module_name = $this->router->getModuleName();
            $this->assets->addJs('apps/document/js/index-letterhead.js');
            $ComInfo = CompanyInfo::find();
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
     * @version Yan Lin Pai <wizardrider@gmail.com>
     */
    public function editinfoAction() {
        if (($_FILES['fileToUpload']['size']) != 0) {
            $file_type = $_FILES['fileToUpload']['type'];
            $file_size = $_FILES['fileToUpload']['size'];

            if (($file_size > 10000)) {
                $this->checkimgsize();
            } elseif (($file_type != "image/jpeg") && ($file_type != "image/jpg") && ($file_type != "image/gif") && ($file_type != "image/png")
            ) {
                $this->checkimgtype();
            }
        } else {
            $MY_FILE = $_FILES['fileToUpload']['tmp_name'];
            $file = fopen($MY_FILE, 'r');
            $file_content = fread($file, filesize($MY_FILE));
            fclose($file);
            $file_contents = addslashes($file_content);
            $update_info = $this->request->getPost('update');
            $ComInfo = new CompanyInfo();
            $ComInfo->editCompanyInfo($update_info, $file_contents);
            $this->response->redirect("document/index/letterhead");
        }
    }

    public function checkimgsize() {
        $localhost = ($this->request->getServer('HTTP_HOST'));
        $message = 'File too large. File must be less than 10 megabytes.';
        echo '<script type="text/javascript">alert("' . $message . '");</script>';
        $page = "http://" . $localhost . "/salts/document/index/letterhead";
        $sec = "0";
        header("Refresh: $sec; url=$page");
    }

    public function checkimgtype() {
        $localhost = ($this->request->getServer('HTTP_HOST'));
        $message = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
        echo '<script type="text/javascript">alert("' . $message . '");</script>';
        $page = "http://" . $localhost . "/salts/document/index/letterhead";
        $sec = "0";
        header("Refresh: $sec; url=$page");
    }

    public function salaryreferAction() {


            $this->view->module_name = $this->router->getModuleName();
            $this->assets->addJs('apps/document/js/index-print.js');


            $SalaryDetail = new \salts\Document\Models\SalaryDetail();
            $salary = \salts\Document\Models\SalaryDetail::find(array(
                        'order' => 'pay_date DESC',
                        "limit" => 1
            ));
            $data = explode("-", $salary[0]->pay_date);
            $month = $data['1'];
            $year = $data['0'];
            $result = $SalaryDetail->getSalaryReferData($month, $year);
            $ComInfo = CompanyInfo::find();
            $name = $ComInfo['0']->company_name;
            $this->view->salary_info = $result;
            $this->view->com_name = $name;
      
    }

}
