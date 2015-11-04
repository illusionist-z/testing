<?php

namespace workManagiment\Salary\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Salary\Models\SalaryMaster;
use workManagiment\Salary\Models\Allowances;
use workManagiment\Salary\Models\Salary;

class SalaryMasterController extends ControllerBase
{
    public $_addsalary;
    public function initialize() {
        $this->_addsalary= new Salary;
        $this->config = \Module_Config::getModuleConfig('salary');
        $this->setCommonJsAndCss();
        //$this->assets->addJs('apps/salary/js/addsalary.js');
    }

    /**
     * Save salary,tax deduce and allowance to salary master using sanitize
     * @author zinmon
     */
    public function savesalaryAction() {
        $dedution = $this->request->get('checkall');
        $allowance = $this->request->get('check_allow');
        $data['id'] = uniqid();
        $data['member_id'] = $this->request->get('member_id', 'string');
        $data['uname'] = $this->request->get('uname', 'string');
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
        //print_r($data);//exit;
        if ($this->request->isPost()) {
             $user = $this->_addsalary;
             $validate = $user->chk_validate($this->request->getPost());
             
        if(count($validate)){
               foreach ($validate as $message){
                   $json[$message->getField()] = $message->getMessage();
               }
                $json['result'] = "error";
                echo json_encode($json);
                $this->view->disable();
            }     
        else{
        
        $Salarymaster = new SalaryMaster();
        $Salarymaster->savesalarydedution($dedution, $data['member_id'], $data['creator_id']);
        $result = $Salarymaster->savesalary($data);

        $Allowance = new Allowances();
        $saveallowance = $Allowance->saveallowance($allowance, $data['member_id']);
        $msg="success";
        //$this->response->redirect('salary/index/salarylist');
        $this->view->disable();
        echo json_encode($msg);
                
             }
             
             }
       
    }
    
    public function editsalarydetailAction($bsalary,$overtimerate,$allowance,$member_id) {
        //echo $bsalary.' '.$overtimerate.' '.$allowance;exit;
        $Salarymaster = new SalaryMaster();
        $Salarymaster->updatesalarydetail($bsalary,$overtimerate,$member_id);
        $Salarydetail=new SalaryDetail();
        $Salarydetail->updatesalarydetail($allowance,$member_id);
        $this->view->disable();
        echo json_encode($resultsalary);
    }
}

