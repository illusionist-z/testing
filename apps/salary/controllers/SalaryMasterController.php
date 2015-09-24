<?php

namespace workManagiment\Salary\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Salary\Models\SalaryMaster;
use workManagiment\Salary\Models\Allowances;


class SalaryMasterController extends ControllerBase
{
    
    public function initialize() {
        
        $this->config = \Module_Config::getModuleConfig('salary');
        $this->setCommonJsAndCss();
        
    }

    /**
     * Save salary,tax deduce and allowance to salary master using sanitize
     * @author zinmon
     */
    public function savesalaryAction() {
        $dedution = $this->request->get('check_list');
        $allowance = $this->request->get('check_allow');

        $data['id'] = uniqid();
        $data['member_id'] = $this->request->get('uname', 'string');
        //$data['position'] = $this->request->get('position', 'string');
        $data['basic_salary'] = $this->request->get('bsalary', 'int');
        $data['travel_fee'] = $this->request->get('travelfee', 'int');
        $data['over_time'] = $this->request->get('overtime', 'int');
        $data['ssc_emp'] = 2;
        $data['ssc_comp'] = 3;
        $data['allowance_id'] = 0;
        $data['creator_id'] = $this->session->user['member_id'];
        $data['created_dt'] = date("Y-m-d H:i:s");
        $data['updater_id'] = 3;
        $data['updated_dt'] = '00:00:00';
        $data['deleted_flag'] = 0;

        
        $Salarymaster = new SalaryMaster();
        $Salarymaster->savesalarydedution($dedution, $data['member_id'], $data['creator_id']);
        $result = $Salarymaster->savesalary($data);

        $Allowance = new Allowances();
        $saveallowance = $Allowance->saveallowance($allowance, $this->request->get('uname'));

        $this->response->redirect('salary/index/salarylist');
    }
    
    public function editsalarydetailAction($bsalary,$overtimerate,$allowance,$member_id) {
        //echo $bsalary.' '.$overtimerate.' '.$allowance;exit;
        $Salarymaster = new SalaryMaster();
        $Salarymaster->updatesalarydetail($bsalary,$overtimerate,$member_id);
        $Allowance = new Allowances();
        $Allowance->updateallowance($allowance,$member_id);
    }
}

