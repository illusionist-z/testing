<?php

namespace salts\Salary\Controllers;

use salts\Core\Models\Db;
use salts\Salary\Models\SalaryDetail;
use salts\Salary\Models\SalaryMaster;
use salts\Salary\Models\Allowances;
use salts\Salary\Models\Salary;

class SalaryMasterController extends ControllerBase {

    public $_addsalary;

    public function initialize() {
        $this->_addsalary = new Salary;
     //   $this->config = \Module_Config::getModuleConfig('salary');
        $this->setCommonJsAndCss();
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
          $this->view->permission = $this->permission;
    }

    /**
     * Save salary,tax deduce and allowance to salary master using sanitize
     * @author zinmon
     */
    public function savesalaryAction() {
          if ($this->permission == 1) {
        $chkTravelfees = $this->request->get('radTravel');
        $data['no_of_children'] = $this->request->get('no_of_children', 'int');
        $dedution = $this->request->get('checkall');
        $allowance = $this->request->get('check_allow');
        $data['id'] = uniqid();
        $data['member_id'] = $this->request->get('member_id', 'string');
        $data['basic_salary'] = $this->request->get('bsalary', 'int');
        if ($chkTravelfees == 1) {
            $data['travel_fee_perday'] = $this->request->get('travelfees', 'int');
            $data['travel_fee_permonth'] = 0;
        }
        if ($chkTravelfees == 2) {
            $data['travel_fee_perday'] = 0;
            $data['travel_fee_permonth'] = $this->request->get('travelfees', 'int');
        }

        if (null !== $this->request->get('overtime', 'int')) {
            $data['over_time'] = $this->request->get('overtime', 'int');
        } else {
            $data['over_time'] = 0;
        }
        $data['ssc_emp'] = 2;
        $data['ssc_comp'] = 3;
        $sdate = $this->request->get('s_sdate');
        $data['salary_start_date'] = date("Y-m-d", strtotime($sdate));
        $byear = date("Y", strtotime($sdate)) + 1;
        $data['salary_end_date'] = $byear . "-03-31";
        $data['allowance_id'] = 0;
        $data['creator_id'] = $this->session->user['member_id'];
        $data['created_dt'] = date("Y-m-d H:i:s");
        $data['updater_id'] = 3;
        $data['updated_dt'] = '00:00:00';
        $data['deleted_flag'] = 0;
        if ($this->request->isPost()) {
            $user = $this->_addsalary;
            $validate = $user->chkValidate($this->request->getPost());
            if (count($validate)) {
                foreach ($validate as $message) {
                    $json[$message->getField()] = $message->getMessage();
                }
                $json['result'] = "error";
            } else {
                $SalaryMaster = new SalaryMaster();
                //check the member id has been inserted
                $Check_salarymaster = $SalaryMaster->getLatestsalary($data['member_id']);
                if (empty($Check_salarymaster)) {
                    $SalaryMaster->saveSalaryDedution($dedution, $data['no_of_children'], $data['member_id'], $data['creator_id']);
                    $SalaryMaster->savesalary($data);
                    $Allowance = new Allowances();
                    $Allowance->saveAllowance($allowance, $data['member_id']);
                    $json['result'] = "success";
                } else {
                    $json['result'] = "Inserted";
                }
            }
            echo json_encode($json);
            $this->view->disable();
        }
          }
          else {
              echo 'Page Not Found';
          }
    }

    public function editsalarydetailAction() {
                  if ($this->permission == 1) {
        $bsalary = $this->request->get('bsalary');
        $overtimerate = $this->request->get('overtime');
        $member_id = $this->request->get('member_id');
        $overtime_hr = $this->request->get('overtime_hr');
        $allowance = $this->request->get('specific_dedce');
        $year = $this->request->get('year');
        $month = $this->request->get('month');
        $absent = $this->request->get('absent');
        $SalaryMaster = new SalaryMaster();
        $SalaryMaster->updateSalarydetail($bsalary, $overtimerate, $member_id, $overtime_hr);
        $Salarydetail = new SalaryDetail();
        $resultsalary = $Salarydetail->updateSalarydetail($bsalary, $allowance, $member_id, $year, $month, $absent, $overtime_hr, $overtimerate);
        $this->view->disable();
        echo json_encode($resultsalary);
    }
    else{
        echo 'Page Not Found';
    }
    }
    
}
