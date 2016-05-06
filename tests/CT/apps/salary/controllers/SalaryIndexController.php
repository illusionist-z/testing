<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Core\Models\Db;
use salts\Salary\Controllers;
use salts\Salary\Models\SalaryDetail;
use salts\Salary\Models\SalaryMaster;
use salts\Salary\Models\Allowances;
use salts\Salary\Models\SalaryTaxs;
use salts\Salary\Models\SalaryTaxsDeduction;
use salts\Salary\Models\SalaryMemberTaxDeduce;
use Library\Core;

include_once 'tests\CT\apps\LoginForAll.php';


/* * 
 * Description of IndexController
 *
 * @author Ei Thandar Aung 
 */

class SalaryIndexController extends Controllers\IndexController {

    public $month;
    public $year;
    public $name;
    public $member_id;
    public $monthyear;
    public $all_name;
    public $state;
    public $tax;
    public $member;
    public $resign;
    public $tmp;
    public $deduce;
    public $data;

    public function setData($data) {
        $this->data = $data;
    }

    public function setDeduce($deduce) {
        $this->deduce = $deduce;
    }

    public function setMember($member) {
        $this->member = $member;
    }

    public function setResignData($resign) {
        $this->resign = $resign;
    }

    public function setTmp($tmp) {

        $this->tmp = $tmp;
    }

    public function setmember_id($member_id) {
        $this->member_id = $member_id;
    }

    public function setTax($tax) {

        $this->tax = $tax;
    }

    public function setState($state) {

        $this->state = $state;
    }

    public function setAllName($all_name) {
        $this->all_name = $all_name;
    }

    public function setmonthyear($monthyear) {
        $this->monthyear = $monthyear;
    }

    public function setmonth($month) {
        $this->month = $month;
    }

    public function setyear($year) {
        $this->year = $year;
    }

    public function setname($name) {
        $this->name = $name;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();

        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays');
        $this->salaryconfig = \Library\Core\Models\Config::getModuleConfig('salary');
        $this->setCommonJsAndCss();

        $this->act_name = "salary";
        $this->permission = "1";
        $this->assets->addCss('common/css/css/style.css');
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {

                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {

                $Noti = $Admin->getUserNoti($id, 1);
            }
        }
        $moduleIdCallCore = new Db\CoreMember();
        $this->module_name = "salary";
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->module_name, $this->session->module);
    }

    public function salarylistAction($exportMode = null) {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/salary/js/base.js');
            $SalaryDetail = new SalaryDetail();
            $curretPage = $this->request->get("page");


            if ($this->permission == 1) {
                if (0 == $exportMode) {
                    $get_salary_detail = $SalaryDetail->getSalaryDetail($curretPage, 1);
                    
                }
                return true;
            }
        }
    }

    public function addsalaryAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $this->assets->addJs('apps/salary/js/index-addsalary.js');
            $userlist = new Db\CoreMember();
            $user_name = $userlist::getinstance()->getUserName("Khine Thazin Phyo");
            $Allowance = new SalaryAllowances();
            $getall_allowance = $Allowance->getAllallowances();
            $TaxDeduction = new TaxsDeduction();
            $deduce = $TaxDeduction->getDeducelist();
            return true;
        }
    }

    public function showsalarylistAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/salary/js/base.js');
            $this->assets->addJs('apps/salary/js/index-show-salarylist.js');
            $month = $this->month;

            $year = $this->year;
            $SalaryDetail = new SalaryDetailTest();
            $get_salary_list = $SalaryDetail->salarylist($month, $year);

            $UserList = new Db\CoreMember();
            $user_name = $UserList->find();
            return true;
        }
    }

    public function autolistAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $UserList = new Db\CoreMember();
            $username = $UserList->autoUsername();

            return true;
        }
    }

    public function monthlysalaryAction($exportMode = null) {
        $this->initialize();
        if ($this->permission == 1) {
            $this->assets->addJs('apps/salary/js/base.js');
            $this->assets->addJs('apps/salary/js/index-addsalary.js');
            $currentPage = $this->request->get("page");
            $SalaryDetail = new SalaryDetail();
            if (0 == $exportMode) {
                $get_eachmonth_salary = $SalaryDetail->getEachmonthsalary($currentPage,1);
            }
            return true;
        }
    }

    public function payslipAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $this->assets->addJs('apps/salary/js/base.js');

            $member_id = "76efdcbe-c897-11e5-9e13-4c3488333b45";
            $month = "2";
            if ($month < 10) {
                $month = '0' . $month;
            }

            $year = "2016";
            $SalaryDetail = new SalaryDetailTest();
            $get_salary_detail = $SalaryDetail->getPayslip($member_id, $month, $year);
            $get_allowance = $SalaryDetail->getAllowanceByMemberid($member_id);
            return true;
        }
    }

    public function salSettingAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $sett['deduc_name'] = _('deduc_name');
            $sett['deduc_amount'] = _('deduc_amount');
            $sett['sett_title'] = _('sett_title');
            $sett['write_name'] = _('write_name');
            $sett['write_amount'] = _('write_amount');
            $sett['save'] = _('save');
            $sett['cancel'] = _('cancel');
            return true;
        }
    }

    public function getmemberidAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $data = $this->name;
            $SalaryDetail = new Master();
            $cond = $SalaryDetail->memidsalary($data);

            return $cond;
        }
    }

    public function allowanceAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $this->assets->addJs('apps/salary/js/index-allowance.js');
            $AllList = new \salts\Salary\Models\Allowances();
            $list = $AllList->showAlwlist();

            return true;
        }
    }

    public function saveallowanceAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $all_name = $this->all_name['all_name'];
            $all_value = $this->all_name['all_value'];

            if (!empty($all_name) && $this->state == 1) {

                $Allowance = new SalaryAllowances();
                $Allowance->addAllowance($all_value, $all_name, 2);
                $this->response->redirect('salary/index/allowance');
                $this->flashSession->success("Allowances are added successfully!");
                return "Allowances are added successfully!";
            } else {
                $this->response->redirect('salary/index/allowance');
                $this->flashSession->success("No data!Insert Data First");
                return "No data!Insert Data First";
            }
        }
    }

    public function editallowanceAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $AllList = new \salts\Salary\Models\Allowances();
            $list = $AllList->showAlwlist();
            $all_id = $list[0]['allowance_id'];
            $Allowance = new SalaryAllowances();
            $data = $Allowance->editAll($all_id);
            $data[1]['allowance_name'] = _("allowance_name");
            $data[1]['allowance_edit'] = _("allowance_edit");
            $data[1]['allowance_amt'] = _("allowance_amt");
            $data[1]['save'] = _("save_btn");
            $data[1]['delete'] = _("delete_btn");
            $data[1]['cancel'] = _("cancel_btn");
            return true;
        }
    }

    public function editdataAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $AllList = new \salts\Salary\Models\Allowances();
            $list = $AllList->showAlwlist();
            $data['id'] = $list[0]['allowance_id'];
            $data['name'] = $this->all_name['all_name'];
            $data['allowance_amount'] = $this->all_name['all_value'];
            $Allowance = new Allowances();
            $Allowance->editAllowance($data);
            return $data['name'];
        }
    }

    public function deletedataAction() {
        $this->initialize();
        $AllList = new SalaryAllowances();
        $list = $AllList->showAlwlist();
        $id = $list[0]['allowance_id'];
        $Allowance = new SalaryAllowances();
        $Allowance->deleteAllowance($id);
        return true;
    }

    public function salarysettingAction() {

        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/salary/js/index-salarysetting.js');
            $Admin = new Db\CoreMember;
            $id = $this->session->user['member_id'];
            $Noti = $Admin->getAdminNoti($id, 0);
            $Tax = new SalaryTaxs();
            $list = $Tax->getTaxlist();
            $Deduction = new SalaryTaxsDeduction();
            $dlist = $Deduction->getDeducelist();
            if ($this->permission == 1) {
                return true;
            }
        }
    }

    public function taxdiaAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $id = "1";
            $Tax = new TaxsTest();
            $data = $Tax->getTaxdata($id);
            $data['t']['tax_edit'] = _("tax_edit");
            $data['t']['tax_from'] = _("tax_from");
            $data['t']['tax_to'] = _("tax_to");
            $data['t']['tax_rate'] = _("tax_rate");
            $data['t']['ssc_emp'] = _("ssc_emp");
            $data['t']['ssc_comp'] = _("ssc_comp");
            $data['t']['save'] = _("edit_btn");
            $data['t']['cancel'] = _("cancel_btn");
            return true;
        }
    }

    public function edit_taxAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $data['id'] = 1;
            $data['taxs_from'] = $this->tax['taxs_from'];
            $data['taxs_to'] = $this->tax['taxs_to'];
            $data['ssc_emp'] = $this->tax['ssc_emp'];
            $data['ssc_comp'] = $this->tax['ssc_comp'];
            $data['taxs_rate'] = $this->tax['taxs_rate'];
            $SalaryTax = new TaxsTest();
            $SalaryTax->editTax($data);
            return true;
        }
    }

    public function dectdiaAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $id = 1;
            $Deduction = new TaxsDeduction();
            $data = $Deduction->getdectdata($id);
            $data['t']['edit_deduct_title'] = _("taxeditform");
            $data['t']['edit_deduct_name'] = _("deduction_name");
            $data['t']['edit_deduct_amount'] = _("deduction_amt");
            $data['t']['save'] = _("save_btn");
            $data['t']['delete'] = _("delete_btn");
            $data['t']['cancel'] = _("cancel_btn");


            return true;
        }
    }

    public function addDectAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $data['deduce_name'] = $this->deduce['deduce_name'];
            $data['amount'] = $this->deduce['amount'];
            $Deduction = new TaxsDeduction();
            $Deduction->addDeduction($data);
            return true;
        }
    }

    public function show_add_dectAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $data[1]['deduce_frm'] = _("deduce_frm");
            $data[1]['deduce_name'] = _("deduce_name");
            $data[1]['amount'] = _("amount");
            $data[1]['wr_deduce_name'] = _("wr_deduce_name");
            $data[1]['wr_deduce_amount'] = _("wr_deduce_amount");
            $data[1]['save'] = _("save_btn");
            $data[1]['cancel'] = _("cancel_btn");
            return true;
        }
    }

    public function delete_deductAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $Deduction = new TaxsDeduction();
            $list = $Deduction->getDeducelist();

            $deduce_id = $list[5]['deduce_id'];

            $Deduction->deleteDeduction($deduce_id);
            return true;
        }
    }

    public function printsalaryAction() {
        $this->initialize();
        $this->assets->addJs('apps/salary/js/index-print.js');
        $month = $this->member['month'];
        $year = $this->member['year'];
        $member_id = $this->member['member_id'];

        $mid = explode(',', $member_id);
        $SalaryDetail = new SalaryDetail();
        for ($i = 0; $i < count($mid); $i++) {

            if ($mid[$i] != 'on') {
                $getsalarydetail[] = $SalaryDetail->getPayslip($mid[$i], $month, $year);
            }
        }

        return true;
    }

    public function salarydetailAction() {
        $this->initialize();

        $this->assets->addJs('apps/salary/js/index-salarydetail.js');
        $month = $this->member['month'];
        $year = $this->member['year'];
        $member_id = $this->member['member_id'];
        $mid = explode(',', $member_id);

        $SalaryDetail = new SalaryDetail();
        for ($i = 0; $i < count($mid); $i++) {

            if ($mid[$i] !== 'on') {
                $getsalarydetail[] = $SalaryDetail->getpayslip($mid[$i], $month, $year);
            }
        }

        return true;
    }

    public function addresigndateAction() {

        $this->initialize();

        $SalaryDetail = new SalaryDetailTest();
        $data['member_id'] = $this->resign['member_id'];
        $data['resign_date'] = $this->resign['date'];
        $SalaryDetail->addResign($data);
        return true;
    }

    public function checkmonthyearAction() {
        $this->initialize();
        $this->assets->addJs('apps/salary/js/base.js');
        $monthyear = $this->monthyear;

        $SalaryDetail = new SalaryDetailTest();
        $result = $SalaryDetail->findMonthyear($monthyear);
        if ($result) {
            $msg = "found";
            return $msg;
        }
    }

    public function csvimportAction($id) {
        $this->initialize();
        $status = array();

        //check file exist   
        $_FILES['file']['name'] = $this->name;
        (count($_FILES) == 0) ? $ext = array() : $ext = explode(".", $_FILES['file']['name']);
        //check file xls exist
        if (end($ext) == "xls" || end($ext) == "xlsx") {
            $status[0] = "Covert excel file to csv !!";
            return $status;
        } //check file is not csv
        else if (end($ext) != "csv") {
            $status[1] = "Invalid file format . (CSV only allowed)";

            return $status;
        } else {
            $tmp = (dirname(__DIR__) . '\tmp' . $this->tmp);
            $_FILES['file']['tmp_name'] = $tmp;
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
                    (gettype($v) === "object") ? $temp .= $v->getMessage() . " ," : $err_txt .= $v . " ,";
                }
            }
            (strlen($temp) > 0) ? $temp = substr_replace($temp, "", -1) : $temp = substr_replace($err_txt, "", -1);
            $status[2] = $temp;
            fclose($file);
            return $status;
        }
    }

    public function downloadcsvAction($id) {
        $this->initialize();
        (1 == $id) ? $title = "salary_data_" : $title = "salary_detail_";
        $file_name = $title . date('Ymd') . ".csv";
        $output = fopen('php://output', 'w');
        $core = new Db\CoreMember();
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
        return true;
        exit;
    }

    public function memberidforprintAction() {
        $this->initialize();
        $this->assets->addJs('apps/salary/js/index-print.js');
        $member_id = $this->member_id;
        $paydate = "2016-03-31";
        $SalaryDetail = new SalaryDetailTest();
        $result = $SalaryDetail->addMemberid($member_id, $paydate);

        if ($result) {
            $msg = "success";
        } else {
            $msg = "nosuccess";
        }
        return $msg;
    }

    public function editsalaryAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $UserList = new Db\CoreMember();
            $username = $UserList->autoUsername();
            $member_id = $username[10]["member_id"];
            $SalaryMaster = new Master();
            $edit_salary = $SalaryMaster->editSalary($member_id);
            $resultsalary['data'] = $edit_salary;

            $PermitAllowance = new SalaryDetailTest();

            $resultsalary['permit_allowance'] = $PermitAllowance->getAllowanceByMemberid($edit_salary[0]['member_id']);

            $PermitDedution = new SalaryMemberTaxDeduce();
            $resultsalary['permit_dedution'] = $PermitDedution->getDeduceBymemberid($edit_salary[0]['member_id']);
            $resultsalary['no_of_children'] = $PermitDedution->getNoOfChildrenBymemberid($edit_salary[0]['member_id']);
            $Dedution = new TaxsDeduction();
            $resultsalary['dedution'] = $Dedution->getDeducelist();
            $Allowance = new SalaryAllowances();
            $resultsalary['allowance'] = $Allowance->getAllallowances();
            return true;
        }
    }

    public function btneditAction() {
        $this->initialize();
        if ($this->permission == 1) {


            $SalaryDetail = new Master();

            $cond = $SalaryDetail->btnedit($this->data);

            $check_deduce = $this->data['check_list'];
            $check_allow = $this->data['check_allow'];
            $Taxdeduce = new TaxDeduce();
            $Taxdeduce->editTaxByMemberid($check_deduce, $this->data['no_of_children'], $this->data['member_id']);
            $SalaryMasterAllowance = new \salts\Salary\Models\SalaryMasterAllowance();
            $var = $SalaryMasterAllowance->editAllowanceByMemberid($check_allow, $this->data['member_id']);
            return true;
        }
    }

    public function calSalaryAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $tras['cal_title'] = _('cal_title');
            $tras['cal_text'] = _('calSalary_noti');
            $tras['cal_placehd'] = _('calSalary_m');
            $tras['cal_yes'] = _('save_btn');
            $tras['cal_no'] = _('cancel');
        }
        return true;
    }

    public function editDeductAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $TaxDeduction = new TaxsDeduction();
            $deduce = $TaxDeduction->getDeducelist();

            $deduce[0]['deduce_name'] = $this->data['deduce_name'];
            $deduce[0]['amount'] = $this->data['amount'];
            $Deduction = new TaxsDeduction();
            $Deduction->editDeduction($deduce[0]);
        }
        return true;
    }

    public function deleteSalaryAction() {
        $this->initialize();
        $member_id = $this->member_id;
        $SalaryMaster = new Master();
        $SalaryMaster->deleteSalaryInfo($member_id);
        return true;
    }

    public function salaryusernameAction() {
        $UserList = new Db\CoreMember();
        $Username = $UserList->autoUsername();
        return true;
    }

}
