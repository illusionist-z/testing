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
        $this->setCommonJsAndCss();
        $this->assets->addCss('apps/salary/css/index_show_salarylist.css');
        $this->assets->addCss('common/css/dialog.css');        
        $this->assets->addCss('apps/salary/css/salary.css');
        $this->assets->addJs('common/js/paging.js');        
        $this->assets->addJs('common/js/export.js');
        //$this->assets->addJs('apps/salary/js/index-allowance.js');
        //$this->assets->addJs('apps/salary/js/index-salarysetting.js');        
        $this->assets->addCss('common/css/css/style.css');
        //$this->view->module_name =  $this->router->getModuleName();
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
        $this->view->module_name =  $this->router->getModuleName();
        $this->view->salarydetail = $getsalarydetail;
        
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
        $this->view->module_name = $this->router->getModuleName();
       
    }

    /**
     * Add salary form
     */
    public function addsalaryAction() {
        //$this->assets->addJs('apps/salary/js/salarymaster-savesalary.js');
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
        $this->view->module_name =  $this->router->getModuleName();
        $this->view->setVar("usernames", $user_name);
        $this->view->position = $position;
        $this->view->getall_allowance = $getall_allowance;
        $this->view->getall_deduce = $deduce;
        
        }
        else {
        $this->response->redirect('core/index');
        }       
    }

     public function autolistAction() {
        $UserList = new Db\CoreMember();
        $Username = $UserList->autousername();
        $this->view->disable();
        echo json_encode($Username);
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
        $this->view->module_name =  $this->router->getModuleName();
        $this->view->setVar("geteachmonthsalarys", $geteachmonthsalary);               
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
        $t = $this->_getTranslation();
        $Salarymaster = new SalaryMaster();
        $editsalary = $Salarymaster->editsalary($member_id);
        $resultsalary['data']=$editsalary;
        $Permit_allowance = new SalaryDetail();
        $resultsalary['permit_allowance'] = $Permit_allowance->getallowanceBymember_id($editsalary[0]['member_id']);
        //print_r($resultsalary['permit_allowance']);
        
        $Permit_dedution = new SalaryMemberTaxDeduce();
        $resultsalary['permit_dedution'] = $Permit_dedution->getdeduceBymember_id($editsalary[0]['member_id']);
        $resultsalary['no_of_children']=$Permit_dedution->getnoofchildrenBymember_id($editsalary[0]['member_id']);
        //print_r($resultsalary['permit_dedution']);exit;
        $Dedution = new SalaryTaxsDeduction();
        $resultsalary['dedution']=$Dedution->getdedlist();
        $Allowance = new Allowances();
        $resultsalary['allowance'] = $Allowance->getall_allowances();
       $resultsalary['t']['title'] = $t->_("edit_salary");
       $resultsalary['t']['name'] = $t->_("name");
       $resultsalary['t']['b_salary'] = $t->_("basic_salary");
       $resultsalary['t']['t_fee'] = $t->_("travel_fee");
       $resultsalary['t']['ot'] = $t->_("overtime");
       $resultsalary['t']['edit_btn'] = $t->_("edit_btn");
       $resultsalary['t']['delete_btn'] = $t->_("delete_btn");
       $resultsalary['t']['cancel_btn'] = $t->_("cancel_btn");
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
        $data['start_date'] = $this->request->getPost('work_sdate');
        $data['no_of_children']=$this->request->getPost('no_of_children');
        $check_allow = $this->request->getPost('check_allow');
        $check_deduce= $this->request->getPost('check_list');
        //print_r($data['start_date']);exit;
        $Salarydetail = new SalaryMaster();
        $cond = $Salarydetail->btnedit($data);
        
        $Taxdeduce=new SalaryMemberTaxDeduce();
        $Taxdeduce->edit_taxByMemberid($check_deduce,$data['no_of_children'],$data['member_id']);
        
        $SalaryMasterAllowance=new \workManagiment\Salary\Models\SalaryMasterAllowance();
        $SalaryMasterAllowance->edit_allowanceByMemberid($check_allow,$data['member_id']);
        
        echo json_encode($cond);
        $this->view->disable();
    }

     /**
     * 
     * get member_id salary Dialog Box
     
     */
    public function getmemberidAction() {
       $data = $this->request->get('uname');
       //print_r($uname);exit;
        $Salarydetail = new SalaryMaster();
        $cond = $Salarydetail->memidsalary($data);
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
        
        $this->view->module_name =  $this->router->getModuleName();
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
     * @update translate #jp
     */
    public function editallowanceAction() {
        $all_id = $this->request->get('id');
        $t = $this->_getTranslation();
        $all = new Allowances();
        $data = $all->editall($all_id);        
        $data[1]['allowance_name'] = $t->_("allowance_name");
        $data[1]['allowance_edit'] = $t->_("allowance_edit");
        $data[1]['allowance_amt'] = $t->_("allowance_amt");
        $data[1]['save'] = $t->_("save_btn");
        $data[1]['delete'] = $t->_("delete_btn");
        $data[1]['cancel'] = $t->_("cancel_btn");
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
        $this->view->module_name =  $this->router->getModuleName();
        $this->view->setVar("noti",$noti);
        $this->view->setVar("deduction", $dlist);
        
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
        $t = $this->_getTranslation();
        $tax = new SalaryTaxs();
        $data = $tax->gettaxdata($id);
        $data[1]['tax_edit'] = $t->_("tax_edit");
        $data[1]['tax_from'] = $t->_("tax_from");
        $data[1]['tax_to'] = $t->_("tax_to");
        $data[1]['tax_rate'] = $t->_("tax_rate");
        $data[1]['ssc_emp'] = $t->_("ssc_emp");
        $data[1]['ssc_comp'] = $t->_("ssc_comp");
        $data[1]['save'] = $t->_("save_btn");
        $data[1]['cancel'] = $t->_("cancel_btn");
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
        $t = $this->_getTranslation();
        $Deduction = new SalaryTaxsDeduction();
        $data = $Deduction->getdectdata($id);
        $data[1]['deduct_name'] = $t->_("deduction_name");
        $data[1]['taxeditform'] = $t->_("taxeditform");
        $data[1]['deduct_amt'] = $t->_("deduction_amt");
        $data[1]['save'] = $t->_("save_btn");
        $data[1]['delete'] = $t->_("delete_btn");
        $data[1]['cancel'] = $t->_("cancel_btn");
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

    public function show_add_dectAction() {
        $t = $this->_getTranslation();
        $data[1]['deduce_frm'] = $t->_("deduce_frm");
        $data[1]['deduce_name'] = $t->_("deduce_name");
        $data[1]['amount'] = $t->_("amount");
        $data[1]['wr_deduce_name'] = $t->_("wr_deduce_name");
        $data[1]['wr_deduce_amount'] = $t->_("wr_deduce_amount");
        $data[1]['save'] = $t->_("save_btn");
        $data[1]['cancel'] = $t->_("cancel_btn");
        $this->view->disable();
        echo json_encode($data);
        
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
        $this->view->year = $year;
        $this->view->month = $month;
    }
    
    public function addresigndateAction(){
        $Salarydetail = new SalaryDetail();
        $data['member_id'] = $this->request->getPost('member_id');
        $data['resign_date'] = $this->request->getPost('resign_date');
        $Salarydetail->addresign($data);
    }
    
    public function delete_salaryAction() {
        $member_id = $this->request->getPost('id');
        $SalaryMaster=new SalaryMaster();
        $SalaryMaster->deleteSalaryInfo($member_id);
        
    }
    
    public function printtaxformAction(){
    
        
    }
    
    public function printtaxAction(){
    
        
    }
    
     //for salary username autocomplete 
    public function salaryusernameAction() {
        //echo json_encode($result);
        $UserList = new Db\CoreMember();
        $Username = $UserList->autousername();
        //print_r($UserList);exit;
        $this->view->disable();
        echo json_encode($Username);
    }
}
