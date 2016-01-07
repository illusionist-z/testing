<?php

namespace salts\Salary\Controllers;

use salts\Core\Models\Db;
use salts\Salary\Models\SalaryDetail;
use salts\Salary\Models\SalaryMaster;
use salts\Salary\Models\Allowances;
use salts\Salary\Models\Salary;

class SalaryMasterController extends ControllerBase
{
    public $_addsalary;
    public function initialize() {
        $this->_addsalary= new Salary;
        $this->config = \Module_Config::getModuleConfig('salary');
        $this->setCommonJsAndCss();
           $this->act_name =  $this->router->getModuleName(); 
        $this->permission = $this->setPermission($this->act_name); 
        //$this->assets->addJs('apps/salary/js/addsalary.js');
    }

    /**
     * Save salary,tax deduce and allowance to salary master using sanitize
     * @author zinmon
     */
    public function savesalaryAction() {
        $data['no_of_children']=$this->request->get('no_of_children', 'int');
        $dedution = $this->request->get('checkall');
        $allowance = $this->request->get('check_allow');
        $data['id'] = uniqid();
        $data['member_id'] = $this->request->get('member_id', 'string');
        //$data['uname'] = $this->request->get('uname', 'string');
        $data['basic_salary'] = $this->request->get('bsalary', 'int');
        $data['travel_fee'] = $this->request->get('travelfee', 'int');
        if(null !==$this->request->get('overtime', 'int'))
        {
        $data['over_time'] = $this->request->get('overtime', 'int');
        }
        else{
        $data['over_time'] = 0;
        }
        $data['ssc_emp'] = 2;
        $data['ssc_comp'] = 3;
        $data['salary_start_date'] = date("Y-m-d H:i:s");
        $data['allowance_id'] = 0;
        $data['creator_id'] = $this->session->user['member_id'];
        $data['created_dt'] = date("Y-m-d H:i:s");
        $data['updater_id'] = 3;
        $data['updated_dt'] = '00:00:00';
        $data['deleted_flag'] = 0;
        //print_r($data['over_time']);exit;
        if ($this->request->isPost()) {
             $user = $this->_addsalary;
             $validate = $user->chk_validate($this->request->getPost());
             
        if(count($validate)){
               foreach ($validate as $message){
                   $json[$message->getField()] = $message->getMessage();
               }
                $json['result'] = "error";
                //echo json_encode($json);
            }     
        else{
       
        $Salarymaster = new SalaryMaster();
        //check the member id has been inserted
        $Check_salarymaster=$Salarymaster->getLatestsalary($data['member_id']);
        if(empty($Check_salarymaster)){
        $Salarymaster->savesalarydedution($dedution,$data['no_of_children'], $data['member_id'], $data['creator_id']);
        $Salarymaster->savesalary($data);

        $Allowance = new Allowances();
        $Allowance->saveallowance($allowance, $data['member_id']);
        $json['result'] = "success";
        }
        else{
        $json['result'] = "Inserted";
        }
        
             }
             //print_r($json);
        echo json_encode($json);
        $this->view->disable();
             }
       
    }
    
    public function editsalarydetailAction($bsalary,$overtimerate,$allowance,$member_id,$year,$month) {
        
        $Salarymaster = new SalaryMaster();
        $Salarymaster->updatesalarydetail($bsalary,$overtimerate,$member_id);
        $Salarydetail=new SalaryDetail();
        $Salarydetail->updatesalarydetail($bsalary,$allowance,$member_id,$year,$month);
        $this->view->disable();
        echo json_encode($resultsalary);
    }
}

