<?php

namespace workManagiment\Document\Controllers;
use workManagiment\Core\Models\Db;
use workManagiment\Document\Models\Document;
use workManagiment\Document\Models\CompanyInfo;
use workManagiment\Core\Models\Db\CoreMember;

class IndexController extends ControllerBase
{
    public $calendar;
    public function initialize() {
        parent::initialize();  
       
        $this->setCommonJsAndCss();
        
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('apps/document/css/index_ssbdocument.css');
        $this->assets->addJs('apps/document/js/FileSaver.js');
        $this->assets->addJs('apps/document/js/FileSaver.min.js');
        $this->assets->addJs('apps/document/js/jquery.wordexport.js');
        
        $this->assets->addJs('apps/document/js/FileSaver.js');
        $this->assets->addJs('apps/document/js/FileSaver.min.js');
        $this->assets->addJs('apps/document/js/jquery.wordexport.js');
        $this->permission = $this->setPermission();
        $code=$this->session->permission_code;
         $Admin=new CoreMember();
        $id = $this->session->user['member_id'];
        if($code=="ADMIN"){
            $noti=$Admin->GetAdminNoti($id);}
        else{
            $id = $this->session->user['member_id'];
            $noti=$Admin->GetUserNoti($id);
        }
        $this->view->setVar("noti",$noti);

    }

    
    /**
     * Show ssb document
     * @author zinmon
     */
    public function ssbdocumentAction() {
        $this->assets->addJs('apps/salary/js/print.js');
        $SalaryDetail= new Document();
        $result=$SalaryDetail->getssb_info();
        $Companyinfo= new CompanyInfo();
        $cominfo= $Companyinfo->GetCompanyInfo();
        
        if($this->permission==1 && $this->session->permission_code=='ADMIN'){
        $this->view->salary_info=$result; 
        $this->view->cominfo=$cominfo;
        }
        else {
            $this->response->redirect('core/index');
        }
    }

    public function taxdocumentAction() {
        $this->assets->addJs('apps/salary/js/print.js');
        $SalaryDetail= new Document();
        $result=$SalaryDetail->getsalary_info();
        
        if($this->permission==1 && $this->session->permission_code=='ADMIN'){
            $this->view->salary_info=$result;
        }
        else {
            $this->response->redirect('core/index');
        }
    }
    
    public function letterheadAction(){
        $this->assets->addJs('apps/document/js/letterhead.js');
        $Cinfo=new \workManagiment\Document\Models\CompanyInfo();
        $info=$Cinfo->GetCompanyInfo();
        
        if($this->permission==1 && $this->session->permission_code=='ADMIN'){
            $this->view->setVar("info",$info);
        }
        else {
            $this->response->redirect('core/index');
        }
    }
    
     /**
     * Edit Company Profile
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function editinfoAction(){
        $filename = rand(1, 99999) . '.' . end(explode(".", $_FILES["fileToUpload"]["name"]));
        $target_dir = "uploads/";
        $target_file = $target_dir . $filename;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $Cinfo=new \workManagiment\Document\Models\CompanyInfo();
        $updateinfo = $this->request->getPost('update');
        //print_r($updateinfo);exit;
        if($_FILES["fileToUpload"]["name"]==null){
            $updateinfo['company_logo']=$updateinfo['temp_logo'];
        }
        else{
            
            $updateinfo['company_logo']=$filename;
        }
               $Cinfo->EditCompanyInfo($updateinfo);
        $this->response->redirect("document/index/letterhead");
    }
    /**
     * @author Su Zin Kyaw<gnext.suzin@gmail.com>
     * showing letterhead page
     */
    public function letterheadAction(){
                $this->assets->addJs('apps/document/js/letterhead.js');

        $Cinfo=new \workManagiment\Document\Models\CompanyInfo();
        $info=$Cinfo->GetCompanyInfo();
        $this->view->setVar("info",$info);
    }
    
     /**
     * Edit Company Profile
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function editinfoAction(){
        $filename = rand(1, 99999) . '.' . end(explode(".", $_FILES["fileToUpload"]["name"]));
        $target_dir = "uploads/";
        $target_file = $target_dir . $filename;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $Cinfo=new \workManagiment\Document\Models\CompanyInfo();
        $updateinfo = $this->request->getPost('update');
        //print_r($updateinfo);exit;
        if($_FILES["fileToUpload"]["name"]==null){
            $updateinfo['company_logo']=$updateinfo['temp_logo'];
        }
        else{
            
            $updateinfo['company_logo']=$filename;
        }
               $Cinfo->EditCompanyInfo($updateinfo);
        $this->response->redirect("document/index/letterhead");
    }
}

