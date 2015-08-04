<?php

namespace workManagiment\Salary\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Salary\Models\SalaryMaster;
class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $this->assets->addCss('common/css/style.css');
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addJs('common/js/jquery.min.js');
        $this->assets->addJs('common/js/popup.js');             //popup message
        $this->assets->addJs('apps/salary/js/salary.js');
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
       
    }
    /**
     * Show salary list
     */
    public function salarylistAction() {
        
        $Salarydetail=new SalaryDetail();
        $getsalarylist=$Salarydetail->salarylist();
        //print_r($getsalarylist);exit;
        $month = $this->config->month;
        $userlist=new Db\CoreMember();
        $user_name = $userlist::getinstance()->getusername();
        
        $this->view->setVar("months", $month);
        $this->view->setVar("usernames", $user_name);
        $this->view->setVar("getsalarylists", $getsalarylist);
    }
    
    /**
     * Add salary form
     */
    public function addsalaryAction(){
        $userlist=new Db\CoreMember();
        $user_name = $userlist::getinstance()->getusername();
        $this->view->setVar("usernames", $user_name);
    }
    
    /**
     * Save salary for salary add form
     */
    public function savesalaryAction() {
        $data['member_id']=$this->request->get('uname');
        $data['basic_salary']=$this->request->get('bsalary');
        $data['travelfee']=$this->request->get('travelfee');
        $data['overtime']=$this->request->get('overtime');
        $Salarymaster=new SalaryMaster();
        $result=$Salarymaster->savesalary($data);
        $this->view->Msg = 'Success';
        $this->view->pick('index/addsalary');
    }

    /**
     * show total salary  of each month
     */
    public function monthlysalaryAction() {
        $Salarydetail=new SalaryDetail();
        $geteachmonthsalary=$Salarydetail->geteachmonthsalary();
        //print_r($geteachmonthsalary);exit;
        $this->view->setVar("geteachmonthsalarys", $geteachmonthsalary);
    }
    
    public function payslipAction() {
        $member_id=$this->request->get('member_id');
        $Salarydetail=new SalaryDetail();
        $getsalarydetail=$Salarydetail->getpayslip($member_id);
        //print_r($getsalarydetail);exit;
        $this->view->getsalarydetails = $getsalarydetail;
        //$this->view->setVar("getsalarydetails", $getsalarydetail);
    }
}

