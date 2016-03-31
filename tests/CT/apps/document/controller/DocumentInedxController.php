<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Core\Models\Db;
use salts\Document\Controllers;
use salts\Document\Models;

include_once 'tests\CT\apps\LoginForAll.php';

require_once 'apps/document/controllers/IndexController.php';
require_once 'apps/core/models/db/CoreMember.php';

/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class DocumentIndexController extends Controllers\IndexController {

    public $member_id;
    public $actname;
    public $module;
    public $act_name;
    public $permission;
    public $key_name;
    public $Admin;
    public $moduleIdCall;
    public $module_id;
    public $data;
    public $login_params = array('company_id' => 'cop1', "member_login_name" => "admin", "password" => "admin");

    public function setmember_id($member_id) {
        $this->member_id = $member_id;
    }

    public function setactname($actname) {
        $this->actname = $actname;
    }

    public function setmodule($module) {
        $this->module = $module;
    }

    public function setpermission($permission) {
        $this->permission = $permission;
    }

    public function setkey_name($key_name) {
        $this->key_name = $key_name;
    }

    public function setmoduleIdCall($moduleIdCall) {
        $this->moduleIdCall = $moduleIdCall;
    }

    public function setmodule_id($module_id) {
        $this->module_id = $module_id;
    }
    public function setdata($data){
        $this->data = $data;
    }
    /*
     * Document IndexController test
     */

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
        $this->setCommonJsAndCss();
        $this->setDocumentJsAndCss();
        $this->act_name = 'admin';

        $this->permission = $this->permission;

        $code = $this->session->permission_code;

        $Admin = new db\CoreMember();
        $id = $this->member_id;

        //$this->view->permission = $this->permission;
        $ModuleIdCallCore = new Db\CoreMember();

        $this->module_name = $this->module;

        $this->moduleIdCall = $ModuleIdCallCore->moduleIdSetPermission($this->module_name, $this->session->module);

        //   $this->view->moduleIdCall = $this->moduleIdCall;
        //  foreach ($this->session->auth as $key_name => $key_value) {

        $key_name = $this->key_name;
        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {
                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $Admin->getUserNoti($id, 1);
            }
        }

        // $this->view->setVar("Noti", $Noti);
        return true;
    }

    /**
     * Show ssb document
     * @author zinmon
     */
    public function ssbdocumentAction() {
        $login = new LoginForAll();
        $login->loginFirst();
        $this->moduleIdCall = $this->moduleIdCall;
        if ($this->moduleIdCall == 1) {

            // $this->view->module_name = $this->router->getModuleName();
            $this->assets->addJs('apps/document/js/index-print.js');
            $SalaryDetail = new Models\Document();
            $result = $SalaryDetail->getSsbInfo();
            $ComInfo = new Models\CompanyInfo();
            //$ComInfo = CompanyInfo::find();
            $coreid = new Models\CorePermissionGroupId();

            if ($this->permission == 1) {
//                $this->view->salary_info = $result;
//                $this->view->cominfo = $ComInfo;
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
        return true;
    }

    /**
     * tax documentation form
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function taxdocumentAction() {
        $login = new LoginForAll();
        $login->loginFirst();

        $ModuleIdCallCore = new Db\CoreMember();
        if ($this->moduleIdCall == 1) {


            $this->assets->addCss('apps/document/css/index_tax.css');
            $this->module_name = $this->module;
            //$this->view->module_name = $this->router->getModuleName();
            $moduleIdCall = $ModuleIdCallCore->moduleIdSetPermission($this->module_name, $this->session->module);


            $this->assets->addJs('apps/document/js/index-print.js');
            $SalaryDetail = new Models\Document();
            $result = $SalaryDetail->getSalaryInfo();

            if ($this->permission == 1) {

                // $this->view->salary_info = $result;
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
        return true;
    }

    /**
     * show letterhead
     * session error
     */
//    public function letterheadAction() {
//$login = new LoginForAll();
//        $login->loginFirst();
//        $ModuleIdCallCore = new Db\CoreMember();
//        if ($this->moduleIdCall == 1) {
//
//            $v = $this->module;
//            $m = $this->module_id;
//      
//          
//            //  $this->view->module_name = $this->router->getModuleName();
//            $moduleIdCall = $ModuleIdCallCore->moduleIdSetPermission($v, $m);
//
//            $this->assets->addJs('apps/document/js/index-letterhead.js');
//            $ComInfo = new Models\CompanyInfo();
//            $ComInfo = CompanyInfo::find();
//            $coreid = new Models\CorePermissionGroupId();
//            if ($this->permission == 1) {
//                // $this->view->setVar("info", $ComInfo);
//            } else {
//                $this->response->redirect('core/index');
//            }
//        } else {
//            $this->response->redirect('core/index');
//        }
//        return true;
//    }

     /**
     * Edit Company Profile
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * @varsion Yan Lin Pai <wizardrider@gmail.com>
     */
//    public function editinfoAction() {
//        $login = new LoginForAll();
////        $login->loginFirst();
//        
//       $localhost = ($this->request->getServer('HTTP_HOST'));
//     //   if ($this->permission == 1) {
//            if (isset($_FILES['fileToUpload'])) {
//                $file_type = $_FILES['fileToUpload']['type'];
//                $file_size = $_FILES['fileToUpload']['size'];
//                //  $file_type = $_FILES['uploaded_file']['type'];
//                //   if (($file_size > 12000000)){      
//                if (($file_size > 1000000)) {
//                    $message = 'File too large. File must be less than 10 megabytes.';
//                    echo '<script type="text/javascript">alert("' . $message . '");</script>';
//                      $page = "http://" . $localhost . "/salts/document/index/letterhead";
//                      $sec = "0";
//                      header("Refresh: $sec; url=$page");
//                } elseif (
//                        ($file_type != "image/jpeg") &&
//                        ($file_type != "image/jpg") &&
//                        ($file_type != "image/gif") &&
//                        ($file_type != "image/png")
//                ) {
//                    $message = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
//                    echo '<script type="text/javascript">alert("' . $message . '");</script>';
//                      $page = "http://" . $localhost . "/salts/document/index/letterhead";
//                      $sec = "0";
//                      header("Refresh: $sec; url=$page");
//                } 
//                $MY_FILE = $_FILES['fileToUpload']['tmp_name'];
//                    $file = fopen($MY_FILE, 'r');
//                    $file_contents = fread($file, filesize($MY_FILE));
//                    fclose($file);
//                    $file_contents = addslashes($file_contents);
//                    $update_info = $this->request->getPost('update');
//                    $ComInfo = new CompanyInfo();
//                    $ComInfo->editCompanyInfo($update_info, $file_contents);
//                    $this->response->redirect("document/index/letterhead");
//                    
//                    echo json_encode('ok');
//            }
//  //      } else {
//    //       echo 'Page Not Found';
//   //     }
//            return true;
//    }
    
     public function salaryreferAction() {

        if ($this->permission == 0) {

           // $this->view->module_name = $this->router->getModuleName();
            $this->assets->addJs('apps/document/js/index-print.js');


            $SalaryDetail = new \salts\Document\Models\SalaryDetail();
            $salary = \salts\Document\Models\SalaryDetail::find(array(
                        'order' => 'pay_date DESC',
                        "limit" => 1
            ));
            $data = $this->data;
            $month = "02";
            $year = "2016";
            $result = $SalaryDetail->getSalaryReferData($month, $year);
            $ComInfo =Models\CompanyInfo::find();
            $name = "G - NEXT Co.,Ltd";
           // $this->view->salary_info = $result;
           // $this->view->com_name = $name;
           
        } else {

            echo 'Page Not Found';
        }
        return true;
    }
}
