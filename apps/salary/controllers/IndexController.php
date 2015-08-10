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
        $this->config = \Module_Config::getModuleConfig('salary');
        $this->assets->addCss('common/css/style.css');
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addJs('common/js/jquery.min.js');
        $this->assets->addJs('common/js/popup.js');             //popup message
        $this->assets->addJs('apps/salary/js/salary.js');
        //$this->assets->addJs('apps/salary/js/jquery-1.3.2.min.js'); increase and descrease textbox
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
       
    }
    /**
     * Show salary list after adding salary of each staff
     */
    public function salarylistAction() {
        
        $Salarydetail=new SalaryDetail();
        $getsalarydetail=$Salarydetail->getsalarydetail();
        $this->view->salarydetail = $getsalarydetail;
        //print_r($getsalarylist);exit;
//        $month = $this->config->month;
//        $userlist=new Db\CoreMember();
//        $user_name = $userlist::getinstance()->getusername();
//        
//        $this->view->setVar("months", $month);
//        $this->view->setVar("usernames", $user_name);
//        $this->view->setVar("getsalarylists", $getsalarylist);
    }
    
    /**
     * Show salary list for monthly detail
     */
    public function show_salarylistAction() {
        $month=$this->request->get('month');
        $Salarydetail=new SalaryDetail();
        $getsalarylist=$Salarydetail->salarylist($month);
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
        $position=$this->config->position;
        $this->view->setVar("usernames", $user_name);
        $this->view->position=$position;
    }
    
    /**
     * Save salary for salary add form
     */
    public function savesalaryAction() {
        $dedution=$this->request->get('check_list');
        $data['member_id']=$this->request->get('uname');
        $data['position']=$this->request->get('position');
        $data['basic_salary']=$this->request->get('bsalary');
        $data['travelfee']=$this->request->get('travelfee');
        $data['overtime']=$this->request->get('overtime');
        //print_r($data);exit;
        $Salarymaster=new SalaryMaster();
        $Salarymaster->savesalary_dedution($dedution,$this->request->get('uname'));
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
    
    /**
     * get detail data for payslip
     */
    public function payslipAction() {
        $member_id=$this->request->get('member_id');
        $Salarydetail=new SalaryDetail();
        $getsalarydetail=$Salarydetail->getpayslip($member_id);
        //print_r($getsalarydetail);exit;
        $this->view->getsalarydetails = $getsalarydetail;
        //$this->view->setVar("getsalarydetails", $getsalarydetail);
    }
    
    /**
     * Edit salary detail
     */
    public function editsalaryAction() {
        $member_id=$this->request->get('member_id');
        $Salarydetail=new SalaryDetail();
        $editsalary=$Salarydetail->editsalary($member_id);
    }
    
    public function allowanceAction() {
    
    }
    
    public function saveallowanceAction() {
        print_r($this->request->get('txt1'));exit;
    }
}

