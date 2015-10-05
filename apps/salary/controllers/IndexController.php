<?php

namespace workManagiment\Salary\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Salary\Models\SalaryMaster;
use workManagiment\Salary\Models\Allowances;
use workManagiment\Salary\Models\Taxs;
use workManagiment\Salary\Models\TaxsDeduction;
use workManagiment\Salary\Models\CoreMemberTaxDeduce;


class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $this->salaryconfig = \Module_Config::getModuleConfig('salary');
        $this->assets->addCss('common/css/style.css');
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('apps/salary/css/salary.css');        
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('common/js/popup.js');    //popup message
        //$this->assets->addJs('apps/salary/js/salary.js');
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('apps/salary/js/index-allowance.js');
        $this->assets->addJs('apps/salary/js/index-salarysetting.js');
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
    }

    public function indexAction() {
        
    }

    /**
     * Show salary list after adding salary of each staff
     */
    public function salarylistAction() {
        $this->assets->addJs('apps/salary/js/salary.js');
         $Admin=new Db\CoreMember;
        $id=$this->session->user['member_id'];
    $noti=$Admin->GetAdminNoti($id);
        $this->view->setVar("noti",$noti);
        $Salarydetail = new SalaryDetail();
        $getsalarydetail = $Salarydetail->getsalarydetail();
        //var_dump($getsalarydetail);exit;
        $this->view->salarydetail = $getsalarydetail;
    }

    /**
     * Show salary list for monthly detail
     * @author zinmon
     */
    public function show_salarylistAction() {
        $this->assets->addJs('apps/salary/js/salary.js');
        $this->assets->addJs('apps/salary/js/index_show_salarylist.js');
        $Admin=new Db\CoreMember;
         $id=$this->session->user['member_id'];
    $noti=$Admin->GetAdminNoti($id);
        $this->view->setVar("noti",$noti);
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
    }

    /**
     * Add salary form
     */
    public function addsalaryAction() {
        $Admin=new Db\CoreMember;
 $id=$this->session->user['member_id'];
    $noti=$Admin->GetAdminNoti($id);        $this->view->setVar("noti",$noti);
        $userlist = new Db\CoreMember();
        $user_name = $userlist::getinstance()->getusername();
        $Allowance = new Allowances();
        $getall_allowance = $Allowance->getall_allowances();
        //print_r($getall_allowance);exit;

        $TaxDeduction=new TaxsDeduction();
        $deduce=$TaxDeduction->getdedlist();
        
        $position = $this->salaryconfig->position;

        $this->view->setVar("usernames", $user_name);
        $this->view->position = $position;
        $this->view->getall_allowance = $getall_allowance;
        $this->view->getall_deduce = $deduce;
    }

   

    /**
     * show total salary  of each month
     */
    public function monthlysalaryAction() {
        $this->assets->addJs('apps/salary/js/salary.js');
         $Admin=new Db\CoreMember;
 $id=$this->session->user['member_id'];
    $noti=$Admin->GetAdminNoti($id);        $this->view->setVar("noti",$noti);
        $Salarydetail = new SalaryDetail();
        $geteachmonthsalary = $Salarydetail->geteachmonthsalary();
        //print_r($geteachmonthsalary);exit;
        $this->view->setVar("geteachmonthsalarys", $geteachmonthsalary);
    }

    /**
     * get detail data for payslip
     */
    public function payslipAction() {
        $this->assets->addJs('apps/salary/js/salary.js');
        $Admin=new Db\CoreMember;
 $id=$this->session->user['member_id'];
    $noti=$Admin->GetAdminNoti($id);        $this->view->setVar("noti",$noti);
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
        $Permit_dedution = new CoreMemberTaxDeduce();
        $resultsalary['permit_dedution'] = $Permit_dedution->getdeduceBymember_id($editsalary[0]['member_id']);
        //print_r($resultsalary['permit_dedution']);exit;
        $Dedution = new TaxsDeduction();
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
        
        $Taxdeduce=new CoreMemberTaxDeduce();
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
        $Admin=new Db\CoreMember;
 $id=$this->session->user['member_id'];
    $noti=$Admin->GetAdminNoti($id);        $this->view->setVar("noti",$noti);
        $All_List = new \workManagiment\Salary\Models\Allowances();
        $list = $All_List->showalwlist();
        $this->view->setVar("list", $list); //paginated data
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
        echo "<script>alert('Allowances Are Added Successfully');</script>";
        echo "<script type='text/javascript'>window.location.href='allowance';</script>";
        
        }
        else{
        echo "<script>alert('No Data.Insert Data First');</script>";
        echo "<script type='text/javascript'>window.location.href='allowance';</script>";
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
        $noti=$Admin->GetAdminNoti();
        $this->view->setVar("noti",$noti);
        $Tax = new Taxs();
        $list = $Tax->gettaxlist();
        $this->view->setVar("result", $list); //paginated data
        $Deduction = new TaxsDeduction();
        $dlist = $Deduction->getdedlist();
        $this->view->setVar("deduction", $dlist);
    }

    /**
     * show tax dialog box
     * @author Su Zin Kyaw
     */
    public function taxdiaAction() {
        $id = $this->request->get('id');

        $tax = new Taxs();
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
        $Tax = new Taxs();
        $Tax->edit_tax($data);
        $this->view->disable();
    }

    /**
     * show dedction dialog box
     * @author Su Zin Kyaw
     */
    public function dectdiaAction() {
        $id = $this->request->get('id');

        $Deduction = new TaxsDeduction();
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
        $Deduction = new TaxsDeduction();

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
        $Deduction = new TaxsDeduction();

        $Deduction->add_deduction($data);
        $this->view->disable();
    }

    /**
     * Delete Deduction 
     * @author Su Zin Kyaw
     */
    public function delete_deductAction() {
        $deduce_id = $this->request->getPost('id');
        $Deduction = new TaxsDeduction();
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
        
      // print_r($getsalarydetail);exit;
        
        $this->view->getsalarydetails = $getsalarydetail;
    }
    
    public function addresigndateAction(){
        $Salarydetail = new SalaryDetail();
        $data['member_id'] = $this->request->getPost('member_id');
        $data['resign_date'] = $this->request->getPost('resign_date');
        $Salarydetail->addresign($data);
    }
}
