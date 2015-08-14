<?php

namespace workManagiment\Salary\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Salary\Models\SalaryMaster;
use workManagiment\Salary\Models\Allowances;
class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $this->config = \Module_Config::getModuleConfig('salary');
        $this->assets->addCss('common/css/style.css');
        $this->assets->addCss('common/css/dialog.css');        
        $this->assets->addCss('common/css/jquery-ui.css');         
        $this->assets->addCss('apps/salary/css/salary.css');
        $this->assets->addJs('common/js/jquery.min.js');
        $this->assets->addJs('common/js/popup.js');             //popup message
        $this->assets->addJs('apps/salary/js/salary.js');
        $this->assets->addJs('common/js/export.js'); 
        $this->assets->addJs('apps/salary/js/allowance.js'); 
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
        //var_dump($getsalarydetail);exit;
        $this->view->salarydetail = $getsalarydetail;
 
    }
    
    /**
     * Show salary list for monthly detail
     */
    public function show_salarylistAction() {
        $month=$this->request->get('month');
        $year=$this->request->get('year');
        $Salarydetail=new SalaryDetail();
        $getsalarylist=$Salarydetail->salarylist($month,$year);
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
        $Allowance=new Allowances();
        $getall_allowance=$Allowance->getall_allowances();
        //print_r($getall_allowance);exit;
        
        $position=$this->config->position;
        
        $this->view->setVar("usernames", $user_name);
        $this->view->position=$position;
        $this->view->getall_allowance=$getall_allowance;
    }
    
    /**
     * Save salary for salary add form
     */
    public function savesalaryAction() {
        $dedution=$this->request->get('check_list');
        $allowance=$this->request->get('check_allow');
        $data['member_id']=$this->request->get('uname');
        $data['position']=$this->request->get('position');
        $data['basic_salary']=$this->request->get('bsalary');
        $data['travelfee']=$this->request->get('travelfee');
        $data['overtime']=$this->request->get('overtime');
        //print_r($data);exit;
        $Salarymaster=new SalaryMaster();
        $Salarymaster->savesalary_dedution($dedution,$this->request->get('uname'));
        $result=$Salarymaster->savesalary($data);
        
        $Allowance=new Allowances();
        $saveallowance=$Allowance->saveallowance($allowance,$this->request->get('uname'));
       
        $this->response->redirect('salary/index/salarylist');
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
        $month=$this->request->get('month');
        $Mth='';
        if($month<10){
           $Mth ='0'.$month;
        }
        $year=$this->request->get('year');
        $Salarydetail=new SalaryDetail();
        $getsalarydetail=$Salarydetail->getpayslip($member_id,$Mth,$year);
        //print_r($getsalarydetail);exit;
        
        $getallowance=$Salarydetail->getallowanceBymember_id($member_id);
        //print_r($getallowance);exit;
        $this->view->getsalarydetails = $getsalarydetail;
        $this->view->getallowance = $getallowance;
    }
    
    /**
     * Edit salary detail
     */
    public function editsalaryAction() {
        $member_id=$this->request->get('id');                
        $Salarydetail=new SalaryMaster();
        $editsalary=$Salarydetail->editsalary($member_id);
        $this->view->disable();
        echo json_encode($editsalary);
    }
    
    
    public function btneditAction() {
        $data['id'] = $this->request->getPost('id');
        $data['uname'] = $this->request->getPost('uname');
        $data['basesalary'] = $this->request->getPost('basesalary');
        $data['travelfee'] = $this->request->getPost('travelfee');
        $data['overtime'] = $this->request->getPost('overtime');
        $data['ssc_emp'] = $this->request->getPost('ssc_emp');
        $data['ssc_comp'] = $this->request->getPost('ssc_comp');
        $Salarydetail = new SalaryMaster();
        $pont=$Salarydetail->btnedit($data);
        echo json_encode($pont);
        $this->view->disable();
    }
    /**
     * show allowance list
     * @author Su Zin kyaw
     */
    public function allowanceAction() {
    $All_List=new \workManagiment\Salary\Models\Allowances();
    $list=$All_List->showalwlist();
    $this->view->setVar("list", $list);//paginated data
    }
    
    /**
     * Adding new allowances to allowance table
     * @author Su Zin Kyaw
     */
    public function saveallowanceAction() {
    for ($x = 1; $x <= 10; $x++) { // getting all value from text boxes
    $all_name['"'.$x.'"']= $this->request->get('textbox'.$x);    
    $all_value['"'.$x.'"']= $this->request->get('txt'.$x);
   // echo $all_name['"'.$x.'"'];echo $all_value['$x'];
    if(!isset($all_name['"'.$x.'"'])){
        $count=$x;break; //getting the number of textboxes
        }
    }
    $all=new \workManagiment\Salary\Models\Allowances();
    $all->addallowance($all_value,$all_name,$count);//sending data to model with array format
    }
    
    /**
     * edit dialog box
     * @author Su Zin Kyaw
     */
    public function editallowanceAction(){
         $all_id=$this->request->get('id'); 
        $all=new Allowances();
        $data=$all->editall($all_id);
        $this->view->disable();
        echo json_encode($data);
    }
    
    /**
     * edit allowance data
     * @author Su Zin Kyaw
     */
    public function edit_dataAction() {
        
        $data['id'] = $this->request->getPost('id');
        $data['name'] = $this->request->getPost('name');
        $data['allowance_amount'] =$this->request->getPost('allowance_amount');
        $all=new Allowances();
        $all->edit_allowance($data);
        $this->view->disable();
    }
    
    /**
     * delete allowance data
     * @author Su Zin Kyaw
     */
    public function delete_dataAction(){
        $id= $this->request->getPost('id');
        
        $all=new Allowances();
        $all->delete_allowance($id);
        $this->view->disable();
    }
}

