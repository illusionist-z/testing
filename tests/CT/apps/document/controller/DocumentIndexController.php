<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Document\Controllers;
use salts\Document\Models;
use salts\Document\Models\Document;
use salts\Document\Models\CompanyInfo;
use salts\Core\Models\Db\CoreMember;
use salts\Core\Models\Db;

include_once 'tests\CT\apps\LoginForAll.php';

require_once 'apps/document/controllers/IndexController.php';
require_once 'apps/core/models/db/CoreMember.php';

/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class DocumentIndexController extends Controllers\IndexController {
    /*
     * Document IndexController test
     */

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
        $this->moduleIdCall = 1;
        $this->permission = 1;
        $this->module_name = "document";
    }

    public function ssbdocumentAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $SalaryDetail = new Document();
            $result = $SalaryDetail->getSsbInfo();
            $ComInfo = CompanyInfo::find();
        }
        return true;
    }

    public function taxdocumentAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $this->assets->addCss('apps/document/css/index_tax.css');
            $this->assets->addJs('apps/document/js/index-print.js');
            $SalaryDetail = new Document();
            $result = $SalaryDetail->getSalaryInfo();
        }
        return true;
    }

    /**
     * show letterhead
     * 
     */
    public function letterheadAction() {
        $this->initialize();

        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/document/js/index-letterhead.js');
            $ComInfo = CompanyInfo::find();

            if ($this->permission == 1) {
                // $this->view->setVar("info", $ComInfo);
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
        return true;
    }

    public $file;

    public function setFile($file) {
        $this->file = $file;
    }

    public function editinfoAction() {
        $this->initialize();
        $_FILES['fileToUpload'] = $this->file;

        if (($_FILES['fileToUpload']['size']) != 0) {

            $file_type = $_FILES['fileToUpload']['type'];
            $file_size = $_FILES['fileToUpload']['size'];
            if (($file_size > 10000)) {
                $result = $this->checkimgsize();
            } elseif (($file_type != "image/jpeg") && ($file_type != "image/jpg") && ($file_type != "image/gif") && ($file_type != "image/png")
            ) {
                $result = $this->checkimgtype();
            }
        } else {
            echo "here";
            $MY_FILE = $_FILES['fileToUpload']['tmp_name'];
            $file = fopen($MY_FILE, 'r');
            $file_content = fread($file, filesize($MY_FILE));
            fclose($file);
            $file_contents = addslashes($file_content);
            $update_info = $this->request->getPost('update');
            $ComInfo = new CompanyInfo();
            $ComInfo->editCompanyInfo($update_info, $file_contents);
            $this->response->redirect("document/index/letterhead");
            return true;
        }
        return $result;
    }

    public function checkimgsize() {
        $localhost = ($this->request->getServer('HTTP_HOST'));
        $message = 'File too large. File must be less than 10 megabytes.';
        $page = "http://" . $localhost . "/salts/document/index/letterhead";
        $sec = "0";
        return $message;
    }

    public function checkimgtype() {
        $localhost = ($this->request->getServer('HTTP_HOST'));
        $message = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
        $page = "http://" . $localhost . "/salts/document/index/letterhead";
        $sec = "0";
        return $message;
    }

    public function salaryreferAction() {
        $this->initialize();
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

        return $name;
    }

}
