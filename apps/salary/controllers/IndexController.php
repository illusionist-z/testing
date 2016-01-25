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

        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $this->salaryconfig = \Module_Config::getModuleConfig('salary');
        $this->assets->addCss('apps/salary/css/index_show_salarylist.css');
        $this->assets->addCss('apps/salary/css/salary.css');
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('common/js/export.js');
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
        $this->view->permission = $this->permission;
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {
                //Go to user dashboard
                $noti = $Admin->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                //Go to admin dashboard
                $noti = $Admin->GetUserNoti($id, 1);
            }
        }

        $this->view->setVar("noti", $noti);
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
        if ($this->permission == 1) {
            $this->view->module_name = $this->router->getModuleName();
            $this->view->salarydetail = $getsalarydetail;
        } else {

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

        $TaxDeduction = new SalaryTaxsDeduction();
        $deduce = $TaxDeduction->getdedlist();

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

        $this->view->module_name = $this->router->getModuleName();
        if ($this->permission === 1) {

            $this->view->setVar("geteachmonthsalarys", $geteachmonthsalary);
        } else {
            //$this->response->redirect('core/index');
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

        $getallowance = $Salarydetail->getallowanceBymember_id($member_id);

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
        $resultsalary['data'] = $editsalary;
        $Permit_allowance = new SalaryDetail();
        $resultsalary['permit_allowance'] = $Permit_allowance->getallowanceBymember_id($editsalary[0]['member_id']);
        //print_r($resultsalary['permit_allowance']);

        $Permit_dedution = new SalaryMemberTaxDeduce();
        $resultsalary['permit_dedution'] = $Permit_dedution->getdeduceBymember_id($editsalary[0]['member_id']);
        $resultsalary['no_of_children'] = $Permit_dedution->getnoofchildrenBymember_id($editsalary[0]['member_id']);
        //print_r($resultsalary['permit_dedution']);exit;
        $Dedution = new SalaryTaxsDeduction();
        $resultsalary['dedution'] = $Dedution->getdedlist();
        $Allowance = new Allowances();
        $resultsalary['allowance'] = $Allowance->getall_allowances();
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

        $Salarydetail = new SalaryMaster();
        $cond = $Salarydetail->btnedit($data);

        $Taxdeduce = new SalaryMemberTaxDeduce();
        $Taxdeduce->edit_taxByMemberid($check_deduce, $data['no_of_children'], $data['member_id']);

        $SalaryMasterAllowance = new \salts\Salary\Models\SalaryMasterAllowance();
        $SalaryMasterAllowance->edit_allowanceByMemberid($check_allow, $data['member_id']);

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
        $All_List = new \salts\Salary\Models\Allowances();
        $list = $All_List->showalwlist();
        //echo $this->permission;
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
            $all = new \salts\Salary\Models\Allowances();
            $all->addallowance($all_value, $all_name, $count);
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
     * get translation for allowance text box
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function gettranslateAction() {
        //echo "aa";exit;
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
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti = $Admin->GetAdminNoti($id);

        $Tax = new SalaryTaxs();
        $list = $Tax->gettaxlist();
        $this->view->setVar("result", $list); //paginated data
        $Deduction = new SalaryTaxsDeduction();
        $dlist = $Deduction->getdedlist();
        if ($this->permission === 1) {
            $this->view->module_name = $this->router->getModuleName();
            $this->view->setVar("noti", $noti);
            $this->view->setVar("deduction", $dlist);
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
        $tax = new SalaryTaxs();
        $data = $tax->gettaxdata($id);
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
    public function edit_taxAction() {
        $data['id'] = $this->request->getPost('id');
        $data['taxs_from'] = $this->request->getPost('taxs_from');
        $data['taxs_to'] = $this->request->getPost('taxs_to');
        $data['ssc_emp'] = $this->request->getPost('ssc_emp');
        $data['ssc_comp'] = $this->request->getPost('ssc_comp');
        $data['taxs_rate'] = $this->request->getPost('taxs_rate');
        //print_r($data);exit;
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
    public function delete_deductAction() {
        $deduce_id = $this->request->getPost('id');
        $Deduction = new SalaryTaxsDeduction();
        $Deduction->delete_deduction($deduce_id);
        $this->view->disable();
    }

    /**
     * Print salary action
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function printsalaryAction() {
        $this->assets->addJs('apps/salary/js/print.js');
        $month = $this->request->get('month');
        $year = $this->request->get('year');
        $member_id = $this->request->get('chk_val');
        $mid = explode(',', $member_id);
        //echo count($mid);
        $Salarydetail = new SalaryDetail();
        for ($i = 0; $i < count($mid); $i++) {
            echo $mid[$i] . "<br>";
            if ($mid[$i] != 'on') {
                $getsalarydetail[] = $Salarydetail->getpayslip($mid[$i], $month, $year);
            }
        }

        //print_r($getsalarydetail);exit;
        $this->view->setVar("getsalarydetails", $getsalarydetail);
        //$this->view->getsalarydetails = $getsalarydetail;
    }

    /**
     * Show salary detail
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia> 
     */
    public function salarydetailAction() {
        $this->assets->addJs('apps/salary/js/index_salarydetail.js');
        $month = $this->request->get('month');
        $year = $this->request->get('year');
        $member_id = $this->request->get('chk_val');
        $mid = explode(',', $member_id);

        $Salarydetail = new SalaryDetail();
        for ($i = 0; $i < count($mid); $i++) {
            echo $mid[$i] . "<br>";
            if ($mid[$i] !== 'on') {
                $getsalarydetail[] = $Salarydetail->getpayslip($mid[$i], $month, $year);
            }
        }
        //exit;
        //var_dump($getsalarydetail);exit;

        $this->view->getsalarydetails = $getsalarydetail;
        $this->view->year = $year;
        $this->view->month = $month;
    }

    /**
     * Save resign date 
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function addresigndateAction() {
        $Salarydetail = new SalaryDetail();
        $data['member_id'] = $this->request->getPost('member_id');
        $data['resign_date'] = $this->request->getPost('resign_date');
        $Salarydetail->addresign($data);
    }

    /**
     * Delete salary detail
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function delete_salaryAction() {
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
        //echo json_encode($result);
        $UserList = new Db\CoreMember();
        $Username = $UserList->autousername();
        //print_r($UserList);exit;
        $this->view->disable();
        echo json_encode($Username);
    }

    //for show calculate salary
    public function checkmonthyearAction() {
        $this->assets->addJs('apps/salary/js/salary.js');
        $monthyear = $this->request->get('monthyear');
        // var_dump($monthyear);
        $Salarydetail = new SalaryDetail();
        $result = $Salarydetail->findmonthyear($monthyear);
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
    public function csvimportAction() {
        $filter = new Filter();
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
                while (($data = fgetcsv($file, 10000, "\t")) !== FALSE) {
                    if (count($data) === 1) {
                        while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
                            $count++;
                          if ($count > 1) {
                        $da = array();
                        //salary master table
                        $da[0]['member_id'] = $filter->sanitize(isset($data[0])?$data[0]:"", "string");
                        $da[0]['basic_salary'] = $filter->sanitize(isset($data[3])?$data[3]:"", "string");
                        $da[0]['travel_fee_perday'] = $filter->sanitize(isset($data[4])?$data[4]:"", "string");
                        $da[0]['travel_fee_permonth'] = $filter->sanitize(isset($data[5])?$data[5]:"", "string");
                        $da[0]['over_time'] = $filter->sanitize(isset($data[6])?$data[6]:"", "int");
                        $da[0]['ssc_emp'] = $filter->sanitize(isset($data[7])?$data[7]:"", "int");
                        $da[0]['ssc_comp'] = $filter->sanitize(isset($data[8])?$data[8]:"", "int");
                        $da[0]['salary_start_date'] = $filter->sanitize(isset($data[9])?$data[9]:"", "date");
                        $da[0]['salary_end_date'] = "";
                        $da[0]['creator_id'] = $this->session->user['member_id'];
                        //$da[0]['updater_id'] = $this->session->user['member_id'];
                        $da[0]['updated_dt'] = date("Y-m-d H:m:s");
                        //deduce table
                        $da[1]['spouse'] = $filter->sanitize(isset($data[10])?$data[10]:"", "string");
                        $da[1]['children'] = $filter->sanitize(isset($data[11])?$data[11]:"", "string");
                        $da[1]['stay_father'] = $filter->sanitize(isset($data[12])?$data[12]:"", "int");
                        $da[1]['stay_mother'] = $filter->sanitize(isset($data[13])?$data[13]:"", "int");
                        $da[1]['life_insurance'] = $filter->sanitize(isset($data[14])?$data[14]:"", "int");
                        $da[1]['creator_id'] = $this->session->user['member_id'];
                        $da[1]['updated_dt'] = date("Y-m-d H:m:s");
                        //allowance table
                        $da[2]['taxi'] = $filter->sanitize(isset($data[15])?$data[15]:"", "int");
                        $da[2]['service'] = $filter->sanitize(isset($data[16])?$data[16]:"", "int");
                        $da[2]['customer_allowance'] = $filter->sanitize(isset($data[17])?$data[17]:"", "int");
                        
                        
                       $return = $sal->savesalary($da);
                            }
                        }
                    }
                    else{
                    $count++;
                    if ($count > 1) {
                        $da = array();
                        $da['member_id'] = $filter->sanitize(isset($data[0])?$data[0]:"", "string");
                        $da['member_name'] = $filter->sanitize(isset($data[1])?$data[1]:"", "string");
                        $da['status'] = 0;
                        $da['basic_salary'] = $filter->sanitize(isset($data[3])?$data[3]:"", "int");
                        $da['travel_fee_perday'] = $filter->sanitize(isset($data[4])?$data[4]:"", "int");
                        $da['over_time'] = $filter->sanitize(isset($data[6])?$data[6]:"", "int");
                        $da['ssc_emp'] = $filter->sanitize(isset($data[7])?$data[7]:"", "int");
                        $da['ssc_comp'] = $filter->sanitize(isset($data[8])?$data[8]:"", "int");
                        $da['creator_id'] = $this->session->user['member_id'];
                        $da['updater_id'] = $this->session->user['member_id'];
                        $da['updated_dt'] = date("Y-m-d H:m:s");
                       $return = $sal->savesalary($da);
                    }
                }
                }
                $temp = "";
                if(!isset($return)){
                        $temp = "Insert all field data please ,";
                }
                else{                                   
                        foreach ($return as $v) {
                            if (gettype($v) === "object") {
                                $temp .= $v->getMessage() . " ,";
                            } else {
                                $temp .= $v . " ,";
                            }
                        }
                }
                $temp = substr_replace($temp, "", -1);
                $status[2] = $temp;

                echo json_encode($status);
                fclose($file);
            }
            $this->view->disable();
        }
    }

    public function downloadcsvAction() {
        $this->view->disable();
        $file_name = "salary_data_" . date('Ymd') . ".csv";        
        header("Content-type: applicaton/csv");        
        header("Content-Transfer-Encoding: binary");
        header('Pragma: no-cache');                
        header("Content-Type: application/force-download");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=\"$file_name\"");
        header('Content-Encoding: UTF-8');
        echo "\xEF\xBB\xBF"; // UTF-8 BOM        
// create a file pointer connected to the output stream
        ob_start();
        $output = fopen('php://output', 'w');

     // output the column headings                
        $core = new SalaryMaster();
        $salary = new \salts\Salary\Models\Salary();
        $all = $core->getSalMasterField();
        $header = $salary->getHeader($all);
        fputcsv($output, $header);
        $core = new Db\CoreMember();
        $rows = $core->findUserAddSalary();
        //fputcsv($output,array("INSERT DATA FORMAT :: (X)=> Dont edit  ,(INT)=> insert only interger number,(1/0)=> insert 1 if allow or insert 0 if disallow,(n/0)=> insert number of children or 0 if no children"));//rows for example
        //insert member id and name 
        foreach ($rows as $row) {
            fputcsv($output, array($row['member_id'], $row['member_login_name'],$row['full_name']));
        }
        fclose($output);
        exit;
    }

}
