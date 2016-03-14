<?php

namespace salts\Salary\Controllers;

use salts\Core\Models\Db;
use salts\Salary\Models\SalaryDetail;
use salts\Salary\Models\SalaryMaster;
use salts\Salary\Models\Allowances;
use salts\Salary\Models\SalaryTaxs;
use salts\Salary\Models\SalaryTaxsDeduction;
use salts\Salary\Models\SalaryMemberTaxDeduce;
use Phalcon\Filter;

class IndexController extends ControllerBase {  

    public function initialize() {
        $this->setSalaryJsAndCss();
        parent::initialize();
        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays');
        $this->salaryconfig = \Library\Core\Models\Config::getModuleConfig('salary');
        $this->assets->addCss('common/css/bootstrap/bootstrap.min.css');
        $this->assets->addCss('common/css/bootstrap.min.css');
        $this->assets->addCss('common/css/common.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/skins.min.css');


        $this->assets->addJs('common/js/jquery.min.js');
        $this->assets->addJs('common/js/common.js'); 
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('common/js/bootstrap.min.js');
        $this->assets->addJs('common/js/app.min.js');
        $this->assets->addJs('common/js/jquery-ui.js');
        $this->assets->addJs('common/js/notification.js');
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
        $this->view->permission = $this->permission;
        $this->module_name = $this->router->getModuleName();
         $this->assets->addJs('apps/salary/js/base.js');
        $this->assets->addCss('common/css/css/style.css');
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {
                //Go to user dashboard
                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                //Go to admin dashboard
                $Noti = $Admin->getUserNoti($id, 1);
            }
        }

        $this->view->setVar("Noti", $Noti);
        $this->view->t = $this->_getTranslation();
        $moduleIdCallCore = new Db\CoreMember();
        $this->module_name = $this->router->getModuleName();
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->module_name, $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
    }

    public function indexAction() {
        
    }

    /**
     * Show salary list after adding salary of each staff
     */
    public function salarylistAction() {

        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/salary/js/base.js');
            $SalaryDetail = new SalaryDetail();
            $curretPage = $this->request->get("page");
            $get_salary_detail = $SalaryDetail->getSalaryDetail($curretPage);
            if ($this->permission == 1) {
                $this->view->module_name = $this->router->getModuleName();
                $this->view->salarydetail = $get_salary_detail;
            } else {

                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * Show salary list for monthly detail
     * @author zinmon
     */
    public function showsalarylistAction() {

        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/salary/js/base.js');
            $this->assets->addJs('apps/salary/js/index-show-salarylist.js');

            $month = $this->request->get('month');
            $year = $this->request->get('year');
            $SalaryDetail = new SalaryDetail();
            $get_salary_list = $SalaryDetail->salarylist($month, $year);

            $UserList = new Db\CoreMember();
            $user_name = $UserList->find();
             $this->view->setVar("month", $month);
            $this->view->setVar("year", $year);
            $this->view->setVar("usernames", $user_name);
            $this->view->setVar("getsalarylists", $get_salary_list);
        //    $this->view->setVar("allowancenames", $allowancename);
            $this->view->module_name = $this->router->getModuleName();
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * Add salary form
     */
    public function addsalaryAction() {

        $this->assets->addJs('apps/salary/js/index-addsalary.js');
        $userlist = new Db\CoreMember();
        $user_name = $userlist::getinstance()->getUserName();
        $Allowance = new Allowances();
        $getall_allowance = $Allowance->getAllallowances();

        $TaxDeduction = new SalaryTaxsDeduction();
        $deduce = $TaxDeduction->getDeducelist();

        $position = $this->salaryconfig->position;
        if ($this->permission == 1) {
            $this->view->module_name = $this->router->getModuleName();
            $this->view->setVar("usernames", $user_name);
            $this->view->position = $position;
            $this->view->getall_allowance = $getall_allowance;
            $this->view->getall_deduce = $deduce;
        } else {
            $this->response->redirect('core/index');
        }
    }

    public function autolistAction() {
        $UserList = new Db\CoreMember();
        $username = $UserList->autoUsername();
        $this->view->disable();
        echo json_encode($username);
    }

    /**
     * show total salary  of each month
     */
    public function monthlysalaryAction() {
        $this->assets->addJs('apps/salary/js/base.js');
        $this->assets->addJs('apps/salary/js/index-addsalary.js');
        $currentPage = $this->request->get("page");
        $SalaryDetail = new SalaryDetail();
        $get_eachmonth_salary = $SalaryDetail->getEachmonthsalary($currentPage);
        $this->view->module_name = $this->router->getModuleName();
        if ($this->permission === 1) {
            $this->view->setVar("geteachmonthsalarys", $get_eachmonth_salary);
        } else {
            
        }
    }

    /**
     * get detail data for payslip
     */
    public function payslipAction() {
        $this->assets->addJs('apps/salary/js/base.js');

        $member_id = $this->request->get('member_id');
        $month = $this->request->get('month');
        if ($month < 10) {
            $month = '0' . $month;
        }

        $year = $this->request->get('year');
        $SalaryDetail = new SalaryDetail();
        $get_salary_detail = $SalaryDetail->getPayslip($member_id, $month, $year);

        $get_allowance = $SalaryDetail->getAllowanceByMemberid($member_id);

        $this->view->getsalarydetails = $get_salary_detail;
        $this->view->getallowance = $get_allowance;
    }

    /**
     * Edit salary detail
     * @version 9/9/15
     */
    public function editsalaryAction() {
        $member_id = $this->request->get('id');
        $t = $this->_getTranslation();
        $SalaryMaster = new SalaryMaster();
        $edit_salary = $SalaryMaster->editSalary($member_id);
        $resultsalary['data'] = $edit_salary;
        $PermitAllowance = new SalaryDetail();
        $resultsalary['permit_allowance'] = $PermitAllowance->getAllowanceByMemberid($edit_salary[0]['member_id']);


        $PermitDedution = new SalaryMemberTaxDeduce();
        $resultsalary['permit_dedution'] = $PermitDedution->getDeduceBymemberid($edit_salary[0]['member_id']);
        $resultsalary['no_of_children'] = $PermitDedution->getNoOfChildrenBymemberid($edit_salary[0]['member_id']);

        $Dedution = new SalaryTaxsDeduction();
        $resultsalary['dedution'] = $Dedution->getDeducelist();
        $Allowance = new Allowances();
        $resultsalary['allowance'] = $Allowance->getAllallowances();
        $resultsalary['t']['title'] = $t->_("edit_salary");
        $resultsalary['t']['name'] = $t->_("name");
        $resultsalary['t']['b_salary'] = $t->_("basic_salary");
        $resultsalary['t']['t_fee'] = $t->_("travel_fee");
        $resultsalary['t']['ot'] = $t->_("overtime");
        $resultsalary['t']['Decut Name'] = $t->_("Decut Name");
        $resultsalary['t']['Allow Name'] = $t->_("Allow Name");
        $resultsalary['t']['Starting Date'] = $t->_("Starting Date");
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
        $data['radio'] = $this->request->getPost('radTravel');
        $data['overtime'] = $this->request->getPost('overtime');
        $data['ssc_emp'] = $this->request->getPost('ssc_emp');
        $data['ssc_comp'] = $this->request->getPost('ssc_comp');
        $data['start_date'] = $this->request->getPost('work_sdate');
        $data['no_of_children'] = $this->request->getPost('no_of_children');
        $data['travelfee_permonth'] = $this->request->getPost('travelfee_permonth');
        $check_allow = $this->request->getPost('check_allow');
        $check_deduce = $this->request->getPost('check_list');

        $SalaryDetail = new SalaryMaster();
        $cond = $SalaryDetail->btnedit($data);

        $Taxdeduce = new SalaryMemberTaxDeduce();
        $Taxdeduce->editTaxByMemberid($check_deduce, $data['no_of_children'], $data['member_id']);

        $SalaryMasterAllowance = new \salts\Salary\Models\SalaryMasterAllowance();
        $SalaryMasterAllowance->editAllowanceByMemberid($check_allow, $data['member_id']);

        echo json_encode($cond);
        $this->view->disable();
    }

    public function salSettingAction() {
        $t = $this->_getTranslation();
        $sett['deduc_name'] = $t->_('deduc_name');
        $sett['deduc_amount'] = $t->_('deduc_amount');
        $sett['sett_title'] = $t->_('sett_title');
        $sett['write_name'] = $t->_('write_name');
        $sett['write_amount'] = $t->_('write_amount');
        $sett['save'] = $t->_('save');
        $sett['cancel'] = $t->_('cancel');
        echo json_encode($sett);
        $this->view->disable();
    }

    public function calSalaryAction() {
        $t = $this->_getTranslation();
        $tras['cal_title'] = $t->_('cal_title');
        $tras['cal_text'] = $t->_('calSalary_noti');
        $tras['cal_placehd'] = $t->_('calSalary_m');
        $tras['cal_yes'] = $t->_('save_btn');
        $tras['cal_no'] = $t->_('cancel');
        echo json_encode($tras);
        $this->view->disable();
    }

    /**
     * 
     * get member_id salary Dialog Box

     */
    public function getmemberidAction() {
        if ( $this->permission == 1){
        $data = $this->request->get('uname');
        $SalaryDetail = new SalaryMaster();
        $cond = $SalaryDetail->memidsalary($data);
        echo json_encode($cond);
        $this->view->disable();
        }
        else { Echo "Page Not Fond";}
    }

    /**
     * show allowance list
     * @author Su Zin kyaw
     */
    public function allowanceAction() {
        $this->assets->addJs('apps/salary/js/index-allowance.js');
        $AllList = new \salts\Salary\Models\Allowances();
        $list = $AllList->showAlwlist();

        if ($this->permission == 1) {
            $this->view->setVar("list", $list); //paginated data
            $this->view->module_name = $this->router->getModuleName();
        } else {
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
        foreach ($all_name as $key => $value) {
            if (empty($value)) {
                unset($all_name[$key]);
            }
        }
        if (!empty($all_name)) {
            $Allowance = new \salts\Salary\Models\Allowances();
            $Allowance->addAllowance($all_value, $all_name, $count);
               
               
            $this->response->redirect('salary/index/allowance');
            $this->flashSession->success("Allowances are added successfully!");
        } else {
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
        $Allowance = new Allowances();
        $data = $Allowance->editAll($all_id);
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
     * get translation for allowance text box
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function gettranslateAction() {
        $t = $this->_getTranslation();
        $data['allowance_name'] = $t->_("allowance_name");
        $data['amount'] = $t->_("amount");
        $data['enter_allname'] = $t->_("enter_allname");
        $data['enter_allamount'] = $t->_("enter_allamount");
        $this->view->disable();
        echo json_encode($data);
    }

    /**
     * edit allowance data
     * @author Su Zin Kyaw
     */
    public function editdataAction() {
        $data['id'] = $this->request->getPost('id');
        $data['name'] = $this->request->getPost('name');
        $data['allowance_amount'] = $this->request->getPost('allowance_amount');
        $Allowance = new Allowances();
        $Allowance->editAllowance($data);
        $this->view->disable();
    }

    /**
     * delete allowance data
     * @author Su Zin Kyaw
     */
    public function deletedataAction() {
        $id = $this->request->getPost('id');
        $Allowance = new Allowances();
        $Allowance->deleteAllowance($id);
        $this->view->disable();
    }

    /**
     * dispaly salary setting
     * @author Su Zin Kyaw
     */
    public function salarysettingAction() {

        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/salary/js/index-salarysetting.js');
            $Admin = new Db\CoreMember;
            $id = $this->session->user['member_id'];
            $Noti = $Admin->getAdminNoti($id,0);

            $Tax = new SalaryTaxs();
            $list = $Tax->getTaxlist();
            $this->view->setVar("result", $list); //paginated data
            $Deduction = new SalaryTaxsDeduction();
            $dlist = $Deduction->getDeducelist();
            if ($this->permission === 1) {
                $this->view->module_name = $this->router->getModuleName();
                $this->view->setVar("Noti", $Noti);
                $this->view->setVar("deduction", $dlist);
            } else {
                $this->response->redirect('core/index');
            }
        } else {
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
        $Tax = new SalaryTaxs();
        $data = $Tax->getTaxdata($id);
        $data['t']['tax_edit'] = $t->_("tax_edit");
        $data['t']['tax_from'] = $t->_("tax_from");
        $data['t']['tax_to'] = $t->_("tax_to");
        $data['t']['tax_rate'] = $t->_("tax_rate");
        $data['t']['ssc_emp'] = $t->_("ssc_emp");
        $data['t']['ssc_comp'] = $t->_("ssc_comp");
        $data['t']['save'] = $t->_("edit_btn");
        $data['t']['cancel'] = $t->_("cancel_btn");
        $this->view->disable();
        echo json_encode($data);
    }

    /**
     * edit tax data
     * @author Su Zin Kyaw
     */
    public function edittaxAction() {
        $data['id'] = $this->request->getPost('id');
        $data['taxs_from'] = $this->request->getPost('taxs_from');
        $data['taxs_to'] = $this->request->getPost('taxs_to');
        $data['ssc_emp'] = $this->request->getPost('ssc_emp');
        $data['ssc_comp'] = $this->request->getPost('ssc_comp');
        $data['taxs_rate'] = $this->request->getPost('taxs_rate');
        $SalaryTax = new SalaryTaxs();
        $SalaryTax->editTax($data);
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
        $data['t']['edit_deduct_title'] = $t->_("taxeditform");
        $data['t']['edit_deduct_name'] = $t->_("deduction_name");
        $data['t']['edit_deduct_amount'] = $t->_("deduction_amt");
        $data['t']['save'] = $t->_("save_btn");
        $data['t']['delete'] = $t->_("delete_btn");
        $data['t']['cancel'] = $t->_("cancel_btn");
        $this->view->disable();
        echo json_encode($data);
    }

    /**
     * Edit Deduction data
     * @author Su Zin Kyaw
     */
    public function editDeductAction() {
        $data['id'] = $this->request->getPost('id');
        $data['deduce_name'] = $this->request->getPost('deduce_name');
        $data['amount'] = $this->request->getPost('amount');
        $Deduction = new SalaryTaxsDeduction();
        $Deduction->editDeduction($data);
        $this->view->disable();
    }

    /**
     * Add New Dedection 
     * @author Su Zin Kyaw
     */
    public function addDectAction() {

        $data['deduce_name'] = $this->request->getPost('deduce_name');
        $data['amount'] = $this->request->getPost('amount');
        $Deduction = new SalaryTaxsDeduction();
        $Deduction->addDeduction($data);
        $this->view->disable();
    }

    /**
     * show deduction related with salary calculation
     * @author Su Zin Kyaw
     */
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
    public function deleteDeductAction() {
        $deduce_id = $this->request->getPost('id');
        $Deduction = new SalaryTaxsDeduction();
        $Deduction->deleteDeduction($deduce_id);
        $this->view->disable();
    }

    /**
     * Print salary action
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function printsalaryAction() {
        $this->assets->addJs('apps/salary/js/index-print.js');
        $month = $this->request->get('month');
        $year = $this->request->get('year');
        $member_id = $this->request->get('chk_val');
        $mid = explode(',', $member_id);
        $SalaryDetail = new SalaryDetail();
        for ($i = 0; $i < count($mid); $i++) {
            echo $mid[$i] . "<br>";
            if ($mid[$i] != 'on') {
                $getsalarydetail[] = $SalaryDetail->getPayslip($mid[$i], $month, $year);
            }
        }
        $this->view->setVar("getsalarydetails", $getsalarydetail);
    }

    /**
     * Show salary detail
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia> 
     */
    public function salarydetailAction() {
        $this->assets->addJs('apps/salary/js/index-salarydetail.js');
        $month = $this->request->get('month');
        $year = $this->request->get('year');
        $member_id = $this->request->get('chk_val');
        $mid = explode(',', $member_id);

        $SalaryDetail = new SalaryDetail();
        for ($i = 0; $i < count($mid); $i++) {
            echo $mid[$i] . "<br>";
            if ($mid[$i] !== 'on') {
                $getsalarydetail[] = $SalaryDetail->getpayslip($mid[$i], $month, $year);
            }
        }
        $this->view->getsalarydetails = $getsalarydetail;
        $this->view->year = $year;
        $this->view->month = $month;
    }

    /**
     * Save resign date 
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function addresigndateAction() {
        $SalaryDetail = new SalaryDetail();
        $data['member_id'] = $this->request->getPost('member_id');
        $data['resign_date'] = $this->request->getPost('resign_date');
        $SalaryDetail->addResign($data);
    }

    /**
     * Delete salary detail
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function deleteSalaryAction() {
        $member_id = $this->request->getPost('id');
        $SalaryMaster = new SalaryMaster();
        $SalaryMaster->deleteSalaryInfo($member_id);
    }

    public function printtaxformAction() {
        
    }

    public function printtaxAction() {
        
    }

    //for salary username autocomplete 
    public function salaryusernameAction() {
        $UserList = new Db\CoreMember();
        $Username = $UserList->autoUsername();
        $this->view->disable();
        echo json_encode($Username);
    }

    //for show calculate salary
    public function checkmonthyearAction() {
        $this->assets->addJs('apps/salary/js/base.js');
        $monthyear = $this->request->get('monthyear');
        $SalaryDetail = new SalaryDetail();
        $result = $SalaryDetail->findMonthyear($monthyear);
        if ($result) {
            $msg = "found";
        } else {
            $msg = "notfound";
        }
        $this->view->disable();
        echo json_encode($msg);
    }

    /**
     * @author David Jaw Hpan
     * import csv data to sql
     * @19/1/16
     */
    public function csvimportAction($id) {
        $status = array();
        if ($this->request->isAjax()) {
            //check file exist   
            if (count($_FILES) == 0) {
                $ext = array();
            } else {
                $ext = explode(".", $_FILES['file']['name']);
            }
            //check file xls exist
            if (end($ext) == "xls" || end($ext) == "xlsx") {
                $status[0] = "Covert excel file to csv !!";
                echo json_encode($status);
            }
            //check file is not csv
            else if (end($ext) != "csv") {
                $status[1] = "Invalid file format . (CSV only allowed)";
                echo json_encode($status);
            } else {
                $file = fopen($_FILES['file']['tmp_name'], "r");
                $count = 0;
                $sal = new SalaryMaster();
                $SalaryDetail = new SalaryDetail();
                while (($data = fgetcsv($file, 10000, "\t")) !== FALSE) {
                    $data['member_id'] = $this->session->user['member_id'];
                    if (count($data) === 1) {
                        while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
                            $count++;
                            if ($count > 2) {
                                (1 == $id) ? $return = $sal->importSalary($data) : $return = $SalaryDetail->importSalary($data);
                            }
                        }
                    } else {
                        $count++;
                        if ($count > 2) {
                            (1 == $id) ? $return = $sal->importSalary($data) : $return = $SalaryDetail->importSalary($data);
                        }
                    }
                }
                $temp = "";
                $err_txt = "";
                if (!isset($return)) {
                    $temp = "Insert all field data please ,";
                } else {
                    foreach ($return as $v) {
                        if (gettype($v) === "object") {
                            $temp .= $v->getMessage() . " ,";
                        } else {
                            $err_txt .= $v . " ,";
                        }
                    }
                }
                if (strlen($temp) > 0) {
                    $temp = substr_replace($temp, "", -1);
                } else {
                    $temp = substr_replace($err_txt, "", -1);
                }
                $status[2] = $temp;
                echo json_encode($status);
                fclose($file);
            }
            $this->view->disable();
        }
    }

    public function downloadcsvAction($id) {
        $this->view->disable();
        (1 == $id) ? $title = "salary_data_" : $title = "salary_detail_";
        $file_name = "$title" . date('Ymd') . ".csv";
        header("Content-type: application/csv");
        header("Content-Transfer-Encoding: binary");
        header("Content-Disposition: attachment; filename=\"$file_name\";");
        header('Content-Encoding: UTF-8');
        echo "\xEF\xBB\xBF"; // UTF-8 BOM

        ob_start();
        $output = fopen('php://output', 'w');
        $core = new Db\CoreMember();
        // output the column headings 
        //for add salary action
        if (1 == $id) {
            $Master = new SalaryMaster();
            $Salary = new \salts\Salary\Models\Salary();
            $All = $Master->getSalMasterField();
            $header = $Salary->getHeader($All);
            fputcsv($output, $header);
            $rows = $core->findUserAddSalary($id);
            //rows for example
            fputcsv($output, array("THIS LINE IS EXAMPLE INSERT DATA FORMAT (see above column right sign):: {(X) = Dont edit}, {(INT) = insert only interger number},"
                . "{(1/0) = insert 1 if allow or insert 0 if disallow},{(n/0) = insert number of children or 0 if no children},"
                . "{(Y-M-D) = 1993-04-04} @Warn::Don't delete this row"));
            //insert member id and name 
            foreach ($rows as $row) {
                fputcsv($output, array($row['member_id'], $row['member_login_name'], $row['full_name']));
            }
        }
        //salary detail action
        else {
            $SalaryDetail = new SalaryDetail();
            $sal_detail_column = $SalaryDetail->getSalaryDetailField();
            $header = $SalaryDetail->getHeader($sal_detail_column);
            fputcsv($output, $header);
            $rows = $core->findUserAddSalary($id);
            //rows for example
            fputcsv($output, array("THIS LINE IS EXAMPLE INSERT DATA FORMAT (see above column right sign):: {(X) = Dont edit}, {(INT) = insert only interger number},"
                . "{(Y-M-D) = 1993-04-04} @Warn::Don't delete this row"));

            foreach ($rows as $row) {
                fputcsv($output, array($row['member_id'], $row['member_login_name'], $row['full_name']));
            }
        }
        fclose($output);
        exit;
    }

    public function memberidforprintAction() {
        $this->assets->addJs('apps/salary/js/index-print.js');
        $member_id = $this->request->get('member_id');
        $paydate = $this->request->get('paydate');

        $SalaryDetail = new SalaryDetail();
        $result = $SalaryDetail->addMemberid($member_id, $paydate);

        if ($result) {
            $msg = "success";
        } else {
            $msg = "nosuccess";
        }
        $this->view->disable();
        echo json_encode($msg);
    }
    
   

}
