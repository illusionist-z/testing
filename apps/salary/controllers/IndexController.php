<?php

namespace workManagiment\Salary\Controllers;
use Phalcon\Flash\Direct as FlashDirect;
use workManagiment\Core\Models\Db;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Salary\Models\SalaryMaster;
use workManagiment\Salary\Models\Allowances;
use workManagiment\Salary\Models\SalaryTaxs;
use workManagiment\Salary\Models\SalaryTaxsDeduction;
use workManagiment\Salary\Models\SalaryMemberTaxDeduce;


class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $this->salaryconfig = \Module_Config::getModuleConfig('salary');
        //$this->assets->addCss('common/css/style.css');
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('apps/salary/css/salary.css');        
        $this->assets->addJs('common/js/paging.js');
        //$this->assets->addJs('common/js/popup.js');    //popup message
        //$this->assets->addJs('apps/salary/js/salary.js');
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('apps/salary/js/index-allowance.js');
        $this->assets->addJs('apps/salary/js/index-salarysetting.js');
        $this->assets->addJs('apps/salary/js/salarymaster-savesalary.js');

        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
        $this->module_name =  $this->router->getModuleName();
        $this->permission = $this->setPermission();
        $Admin=new Db\CoreMember;
        $id=$this->session->user['member_id'];
        $noti=$Admin->GetAdminNoti($id);
        $this->view->setVar("noti",$noti);
        $this->view->t = $this->_getTranslation();
    }

    public function indexAction() {
        
    }

    /**
     * Show salary list after adding salary of each staff
     */
    public function salarylistAction() {
        $this->assets->addJs('apps/salary/js/salary.js');
        $Salarydetail = new SalaryDetail();
        $getsalarydetail = $Salarydetail->getsalarydetail();
        //var_dump($getsalarydetail);exit;
        if($this->permission==1){
        
        $this->view->salarydetail = $getsalarydetail;
        $this->view->modulename = $this->module_name;
        }
        else {
        $this->response->redirect('core/index');
        }        
    }

    /**
     * Show salary list for monthly detail
     * @author zinmon
     */
    public function show_salarylistAction() {
        $this->assets->addJs('apps/salary/js/salary.js');
        $this->assets->addJs('apps/salary/js/index_show_salarylist.js');
        
        $month = $this->request->get('month');
        $year = $this->request->get('year');
        $Salarydetail = new SalaryDetail();
        $getsalarylist = $Salarydetail->salarylist($month, $year);
        //print_r($getsalarylist);exit;
        
        $userlist = new Db\CoreMember();
        $user_name = $userlist::getinstance()->getusername();
        $this->view->setVar("month", $month);
        $this->view->setVar("year", $year);
        $this->view->setVar("usernames", $user_name);
        $this->view->setVar("getsalarylists", $getsalarylist);
        $this->view->setVar("allowancenames", $allowancename);
        $this->view->modulename = $this->module_name;
       
    }

    /**
     * Add salary form
     */
    public function addsalaryAction() {
        $this->assets->addJs('apps/salary/js/addsalary.js');
        $userlist = new Db\CoreMember();
        $user_name = $userlist::getinstance()->getusername();
        $Allowance = new Allowances();
        $getall_allowance = $Allowance->getall_allowances();
        //print_r($getall_allowance);exit;

        $TaxDeduction=new SalaryTaxsDeduction();
        $deduce=$TaxDeduction->getdedlist();
        
        $position = $this->salaryconfig->position;
        if($this->permission==1){
        $this->view->setVar("usernames", $user_name);
        $this->view->position = $position;
        $this->view->getall_allowance = $getall_allowance;
        $this->view->getall_deduce = $deduce;
        $this->view->modulename = $this->module_name;
        }
        else {
        $this->response->redirect('core/index');
        }       
    }

   

    /**
     * show total salary  of each month
     */
    public function monthlysalaryAction() {
        $this->assets->addJs('apps/salary/js/salary.js');
             
        $Salarydetail = new SalaryDetail();
        $geteachmonthsalary = $Salarydetail->geteachmonthsalary();
        //print_r($geteachmonthsalary);exit;
        if($this->permission==1){
        $this->view->setVar("geteachmonthsalarys", $geteachmonthsalary);
        $this->view->modulename = $this->module_name;
        
        }
        else {
        $this->response->redirect('core/index');
        }        
    }

    /**
     * get detail data for payslip
     */
    public function payslipAction() {
        $this->assets->addJs('apps/salary/js/salary.js');
        
        $member_id = $this->request->get('member_id');
        $month = $this->request->get('month');
        //$Mth = '';
        if ($month < 10) {
            $month = '0' . $month;
        }
        
        $year = $this->request->get('year');
        $Salarydetail = new SalaryDetail();
        $getsalarydetail = $Salarydetail->getpayslip($member_id, $month, $year);
        //print_r($getsalarydetail);exit;

        $getallowance = $Salarydetail->getallowanceBymember_id($member_id);
        //print_r($getallowance);exit;
        
        $this->view->getsalarydetails = $getsalarydetail;
        $this->view->getallowance = $getallowance;
    }

    /**
     * Edit salary detail
     * @version 9/9/15
     */
    public function editsalaryAction() {
        $member_id = $this->request->get('id');
        $Salarydetail = new SalaryMaster();
        $editsalary = $Salarydetail->editsalary($member_id);
        $resultsalary['data']=$editsalary;
        $Permit_allowance = new SalaryDetail();
        $resultsalary['permit_allowance'] = $Permit_allowance->getallowanceBymember_id($editsalary[0]['member_id']);
        //print_r($resultsalary['permit_allowance']);
        $Permit_dedution = new SalaryMemberTaxDeduce();
        $resultsalary['permit_dedution'] = $Permit_dedution->getdeduceBymember_id($editsalary[0]['member_id']);
        //print_r($resultsalary['permit_dedution']);exit;
        $Dedution = new SalaryTaxsDeduction();
        $resultsalary['dedution']=$Dedution->getdedlist();
        $Allowance = new Allowances();
        $resultsalary['allowance'] = $Allowance->getall_allowances();
       
        $this->view->disable();
        echo json_encode($resultsalary);
    }

    /**
     * @author David
     * Edit salary Dialog Box
     * @return true|false
     */
    public function btneditAction() {
        $data['id'] = $this->request->getPost('id');
        $data['member_id'] = $this->request->getPost('member_id');
        $data['uname'] = $this->request->getPost('uname');
        $data['basesalary'] = $this->request->getPost('basesalary');
        $data['travelfee'] = $this->request->getPost('travelfee');
        $data['overtime'] = $this->request->getPost('overtime');
        $data['ssc_emp'] = $this->request->getPost('ssc_emp');
        $data['ssc_comp'] = $this->request->getPost('ssc_comp');
        $check_allow = $this->request->getPost('check_allow');
        $check_deduce= $this->request->getPost('check_list');
        //print_r($data['member_id']);exit;
        $Salarydetail = new SalaryMaster();
        $cond = $Salarydetail->btnedit($data);
        
        $Taxdeduce=new SalaryMemberTaxDeduce();
        $Taxdeduce->edit_taxByMemberid($check_deduce,$data['member_id']);
        
        $SalaryMasterAllowance=new \workManagiment\Salary\Models\SalaryMasterAllowance();
        $SalaryMasterAllowance->edit_allowanceByMemberid($check_allow,$data['member_id']);
        
        echo json_encode($cond);
        $this->view->disable();
    }

    /**
     * show allowance list
     * @author Su Zin kyaw
     */
    public function allowanceAction() {
        $this->assets->addJs('apps/salary/js/index-allowance.js');
               
        $All_List = new \workManagiment\Salary\Models\Allowances();
        $list = $All_List->showalwlist();
        //echo $this->permission;
        if($this->permission==1){
        $this->view->setVar("list", $list); //paginated data
        $this->view->modulename = $this->module_name;
        }
        else {
        $this->response->redirect('core/index');
        }
        
    }

    /**
     * Adding new allowances to allowance table
     * @author Su Zin Kyaw
     */
    public function saveallowanceAction() {
        for ($x = 1; $x <= 10; $x++) { // getting all value from text boxes
            $all_name['"' . $x . '"'] = $this->request->get('textbox' . $x);
            $all_value['"' . $x . '"'] = $this->request->get('txt' . $x);
            if (!isset($all_name['"' . $x . '"'])) {
                $count = $x;
                
                break; //getting the number of textboxes
            }
        }
        foreach( $all_name as $key => $value )
            {
                if( empty( $value ) )
                {
                   unset( $all_name[$key] );
                }
            }
        if( !empty( $all_name )  )
        {
        $all = new \workManagiment\Salary\Models\Allowances();
        $all->addallowance($all_value, $all_name, $count);
        $this->response->redirect('salary/index/allowance');
        $this->flashSession->success("Allowances are added successfully!");
        
        
        }
        else{
        $this->response->redirect('salary/index/allowance');
        $this->flashSession->success("No data!Insert Data First");
        
        }
    }

    /**
     * edit dialog box
     * @author Su Zin Kyaw
     */
    public function editallowanceAction() {
        $all_id = $this->request->get('id');
        $all = new Allowances();
        $data = $all->editall($all_id);
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
        $data['allowance_amount'] = $this->request->getPost('allowance_amount');
        $all = new Allowances();
        $all->edit_allowance($data);
        $this->view->disable();
    }

    /**
     * delete allowance data
     * @author Su Zin Kyaw
     */
    public function delete_dataAction() {
        $id = $this->request->getPost('id');

        $all = new Allowances();
        $all->delete_allowance($id);
        $this->view->disable();
    }

    /**
     * dispaly salary setting
     * @author Su Zin Kyaw
     */
    public function salarysettingAction() {
        $this->assets->addJs('apps/salary/js/index-salarysetting.js');
        $Admin=new Db\CoreMember;
        $id=$this->session->user['member_id'];
        $noti=$Admin->GetAdminNoti($id);
        
        $Tax = new SalaryTaxs();
        $list = $Tax->gettaxlist();
        $this->view->setVar("result", $list); //paginated data
        $Deduction = new SalaryTaxsDeduction();
        $dlist = $Deduction->getdedlist();
        if($this->permission==1){
        $this->view->setVar("noti",$noti);
        $this->view->setVar("deduction", $dlist);
        $this->view->modulename = $this->module_name;
        }
        else {
        $this->response->redirect('core/index');
        }
    }

    /**
     * show tax dialog box
     * @author Su Zin Kyaw
     */
    public function taxdiaAction() {
        $id = $this->request->get('id');

        $tax = new SalaryTaxs();
        $data = $tax->gettaxdata($id);
        $this->view->disable();
        echo json_encode($data);
    }

    /**
     * edit tax data
     * @author Su Zin Kyaw
     */
    public function edit_taxAction() {
        $data['id'] = $this->request->getPost('id');
        $data['taxs_from'] = $this->request->getPost('taxs_from');
        $data['taxs_to'] = $this->request->getPost('taxs_to');
        $data['ssc_emp'] = $this->request->getPost('ssc_emp');
        $data['ssc_comp'] = $this->request->getPost('ssc_comp');
        $data['taxs_rate'] = $this->request->getPost('taxs_rate');
        $SalaryTax = new SalaryTaxs();
        $SalaryTax->edit_tax($data);
        $this->view->disable();
    }

    /**
     * show dedction dialog box
     * @author Su Zin Kyaw
     */
    public function dectdiaAction() {
        $id = $this->request->get('id');

        $Deduction = new SalaryTaxsDeduction();
        $data = $Deduction->getdectdata($id);
        $this->view->disable();
        echo json_encode($data);
    }

    /**
     * Edit Deduction data
     * @author Su Zin Kyaw
     */
    public function edit_deductAction() {
        $data['id'] = $this->request->getPost('id');
        $data['deduce_name'] = $this->request->getPost('deduce_name');
        $data['amount'] = $this->request->getPost('amount');
        $Deduction = new SalaryTaxsDeduction();
        //print_r($data);exit;
        $Deduction->edit_deduction($data);
        $this->view->disable();
    }

    /**
     * Add New Dedection 
     * @author Su Zin Kyaw
     */
    public function add_dectAction() {

        $data['deduce_name'] = $this->request->getPost('deduce_name');
        $data['amount'] = $this->request->getPost('amount');
        $Deduction = new SalaryTaxsDeduction();

        $Deduction->add_deduction($data);
        $this->view->disable();
    }

    /**
     * Delete Deduction 
     * @author Su Zin Kyaw
     */
    public function delete_deductAction() {
        $deduce_id = $this->request->getPost('id');
        $Deduction = new SalaryTaxsDeduction();
        $Deduction->delete_deduction($deduce_id);
        $this->view->disable();
    }

    
    public function printsalaryAction() {
         $this->assets->addJs('apps/salary/js/print.js');
        $month=$this->request->get('month');
        $year=$this->request->get('year');
        $member_id=$this->request->get('chk_val');
        $mid=  explode(',', $member_id);
        //echo count($mid);
        $Salarydetail = new SalaryDetail();
        for($i=0;$i<count($mid);$i++){
            echo $mid[$i]."<br>";
            if($mid[$i]!='on'){
            $getsalarydetail[] = $Salarydetail->getpayslip($mid[$i], $month, $year);
                
            }
        }
        
       //print_r($getsalarydetail);exit;
        
        $this->view->getsalarydetails = $getsalarydetail;
    }
    
    
    public function salarydetailAction() {
        $this->assets->addJs('apps/salary/js/index_salarydetail.js');
        $month=$this->request->get('month');
        $year=$this->request->get('year');
        $member_id=$this->request->get('chk_val');
        $mid=  explode(',', $member_id);
        //echo count($mid);
        $Salarydetail = new SalaryDetail();
        for($i=0;$i<count($mid);$i++){
            echo $mid[$i]."<br>";
            if($mid[$i]!='on'){
            $getsalarydetail[] = $Salarydetail->getpayslip($mid[$i], $month, $year);
                
            }
        }
        
      //print_r($getsalarydetail);exit;
        
        $this->view->getsalarydetails = $getsalarydetail;
    }
    
    public function addresigndateAction(){
        $Salarydetail = new SalaryDetail();
        $data['member_id'] = $this->request->getPost('member_id');
        $data['resign_date'] = $this->request->getPost('resign_date');
        $Salarydetail->addresign($data);
    }
    
    public function delete_salaryAction() {
        $member_id = $this->request->getPost('id');
        $sql_salarymaster="DELETE FROM salary_master  WHERE member_id='".$member_id."'";
        $this->db->query($sql_salarymaster);
        $sql_salaryallowance="DELETE FROM salary_master_allowance WHERE member_id='".$member_id."'";
        $this->db->query($sql_salaryallowance);
        $sql_salaryallowance="DELETE FROM salary_member_tax_deduce WHERE member_id='".$member_id."'";
        $this->db->query($sql_salaryallowance);
    }
}
