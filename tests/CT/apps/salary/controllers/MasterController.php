<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Core\Models\Db;
use salts\Salary\Controllers;
use salts\Salary\Models;

include_once 'tests\CT\apps\LoginForAll.php';

require_once 'apps/salary/controllers/SalaryMasterController.php';
require_once 'apps/core/models/db/CoreMember.php';
require_once 'library/core/Controller.php';

/**
 * Description of SalaryMasterController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class MasterController extends Controllers\SalaryMasterController {

    public $module_name;
    public $member_id;
    public $uname;
    public $bsalary;
    public $permission;
    public $SalaryMaster;
    public $overtime_hr;
    public $allowance;
    public $year;
    public $month;
    public $absent;
    public $login_params = array('company_id' => 'cop1', "member_login_name" => "admin", "password" => "admin");

    public function setmodule_name($module_name) {
        $this->module_name = $module_name;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
    }

    public function setmember_id($member_id) {
        $this->member_id = $member_id;
    }

    public function setuname($uname) {
        $this->uname = $uname;
    }

    public function setpermission($permission) {
        $this->permission = $permission;
    }
    
     public function setbsalary($bsalary) {
        $this->bsalary = $bsalary;
    }
    
    public function setallowance($allowance) {
        $this->allowance = $allowance;
    }
     public function setovertime($overtime) {
        $this->overtime = $overtime;
    }
    
     public function setovertime_hr($overtime_hr) {
        $this->overtime_hr = $overtime_hr;
    }
    public function setyear($year) {
        $this->year = $year;
    }
    public function setmonth($month) {
        $this->month = $month;
    }
    public function setabsent($absent) {
        $this->absent = $absent;
    }

   

    /**
     * Save salary,tax deduce and allowance to salary master using sanitize
     * @author zinmon
     */
    public function savesalaryAction() {
        $this->initialize();

        if ($this->permission == 1) {
//        $chkTravelfees = $this->request->get('radTravel');
//        $data['no_of_children'] = $this->request->get('no_of_children', 'int');
//        $dedution = $this->request->get('checkall');
//        $allowance = $this->request->get('check_allow');
            $data['id'] = uniqid();
            $member_id = $this->member_id;

            $data['basic_salary'] = $this->bsalary;
//        if ($chkTravelfees == 1) {
//            $data['travel_fee_perday'] = $this->request->get('travelfees', 'int');
//            $data['travel_fee_permonth'] = 0;
//        }
//        if ($chkTravelfees == 2) {
//            $data['travel_fee_perday'] = 0;
//            $data['travel_fee_permonth'] = $this->request->get('travelfees', 'int');
//        }
//
//        if (null !== $this->request->get('overtime', 'int')) {
//            $data['over_time'] = $this->request->get('overtime', 'int');
//        } else {
//            $data['over_time'] = 0;
//        }
//        $data['ssc_emp'] = 2;
//        $data['ssc_comp'] = 3;
//        $sdate = $this->request->get('s_sdate');
//        $data['salary_start_date'] = date("Y-m-d", strtotime($sdate));
//        $byear = date("Y", strtotime($sdate)) + 1;
//        $data['salary_end_date'] = $byear . "-03-31";
//        $data['allowance_id'] = 0;
//        $data['creator_id'] = $this->session->user['member_id'];
//        $data['created_dt'] = date("Y-m-d H:i:s");
//        $data['updater_id'] = 3;
//        $data['updated_dt'] = '00:00:00';
//        $data['deleted_flag'] = 0;
            $data = array('uname' => $this->uname, 'bsalary' => $this->bsalary);

            $user = new Models\Salary();
            $validate = $user->chkValidate($data);

            if (count($validate)) {
                foreach ($validate as $message) {
                    $json[$message->getField()] = $message->getMessage();
                }
                $json['result'] = "error";
            } else {
                $SalaryMaster = new Models\SalaryMaster();
                //check the member id has been inserted
                $Check_salarymaster = $SalaryMaster->getLatestsalary($member_id);

                if (empty($Check_salarymaster)) {
//                    $SalaryMaster->saveSalaryDedution($dedution, $data['no_of_children'], $data['member_id'], $data['creator_id']);
//                    $SalaryMaster->savesalary($data);
//                    $Allowance = new Allowances();
//                    $Allowance->saveAllowance($allowance, $data['member_id']);
                    $json['result'] = "success";
                } else {
                    $json['result'] = "Inserted";
                }
            }
           // echo json_encode($json);
            // $this->view->disable();
            return $json;
        } else {
            echo 'Page Not Found';
        }
    }

    public function editsalarydetailAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $bsalary = $this->bsalary;
            $overtimerate = $this->overtime;
            $member_id = $this->member_id;
            $overtime_hr = $this->overtime_hr;
            $allowance = $this->allowance;
            $year = $this->year;
            $month = $this->month;
            $absent = $this->absent;
            $SalaryMaster = new Models\SalaryMaster();
            $SalaryMaster->updateSalarydetail($bsalary, $overtimerate, $member_id, $overtime_hr);
            var_dump($SalaryMaster);exit();
            $Salarydetail = new Models\SalaryDetail();
            $resultsalary = $Salarydetail->updateSalarydetail($bsalary, $allowance, $member_id, $year, $month, $absent, $overtime_hr, $overtimerate);
            //$this->view->disable();
            echo json_encode($resultsalary);
        } else {
            echo 'Page Not Found';
        }return true;
    }

}
