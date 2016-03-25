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
        if ($this->moduleIdCall == 1) {
            $this->assets->addCss('apps/document/css/index_tax.css');

            $this->view->module_name = $this->router->getModuleName();
            $moduleIdCall = $ModuleIdCallCore->moduleIdSetPermission($this->module_name, $this->session->module);


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
        if ($this->moduleIdCall == 1) {
            $this->view->module_name = $this->router->getModuleName();
            $moduleIdCall = $ModuleIdCallCore->moduleIdSetPermission($this->module_name, $this->session->module);

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
     * @varsion Yan Lin Pai <wizardrider@gmail.com>
     */
    public function editinfoAction() {
       $localhost = ($this->request->getServer('HTTP_HOST'));
     //   if ($this->permission == 1) {
            if (isset($_FILES['fileToUpload'])) {
                $file_type = $_FILES['fileToUpload']['type'];
                $file_size = $_FILES['fileToUpload']['size'];
                //  $file_type = $_FILES['uploaded_file']['type'];
                //   if (($file_size > 12000000)){      
                if (($file_size > 1000000)) {
                    $message = 'File too large. File must be less than 10 megabytes.';
                    echo '<script type="text/javascript">alert("' . $message . '");</script>';
                      $page = "http://" . $localhost . "/salts/document/index/letterhead";
                      $sec = "0";
                      header("Refresh: $sec; url=$page");
                } elseif (
                        ($file_type != "image/jpeg") &&
                        ($file_type != "image/jpg") &&
                        ($file_type != "image/gif") &&
                        ($file_type != "image/png")
                ) {
                    $message = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
                    echo '<script type="text/javascript">alert("' . $message . '");</script>';
                      $page = "http://" . $localhost . "/salts/document/index/letterhead";
                      $sec = "0";
                      header("Refresh: $sec; url=$page");
                } else {
                         $member = $this->request->getPost();
                       $member_id = $this->session->user['member_id'];
                       $MY_FILE = $_FILES['fileToUpload']['tmp_name'];
                       $image = new \Imagick($MY_FILE); // default 72 dpi image
                       $ReImgdpi = $image->setImageResolution(150,150); 
                       $ImageResolution  = $image->writeImage($ReImgdpi); // this image will have 150 dpi
                        
                    $file = fopen($ImageResolution, 'r');
                    $file_contents = fread($file, filesize($ImageResolution));
                    fclose($file);
                    $file_contents = addslashes($file_contents);
                    $update_info = $this->request->getPost('update');
                    $ComInfo = new CompanyInfo();
                    $ComInfo->editCompanyInfo($update_info, $file_contents);
                    $this->response->redirect("document/index/letterhead");
                }
            }
  //      } else {
    //       echo 'Page Not Found';
   //     }
    }

    public function salaryreferAction() {

        if ($this->permission == 0) {

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
        } else {

            echo 'Page Not Found';
        }
    }

}
