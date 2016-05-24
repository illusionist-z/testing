<?php

namespace salts\Salary\Controllers;

use salts\Salary\Models\SalaryDetail;

class SearchController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->config = \Module_Config::getModuleConfig('salary');
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        if ($this->request->isAjax() == true) {
            $SalaryDetail = new SalaryDetail();
            $cond = $this->request->get('cond', array());
            $search_result = $SalaryDetail->searchSalary($cond);
            $this->view->disable();
            echo json_encode($search_result);
        }
    }

    /**
     * Search travel fees whether per day or per month
     */
    public function searchTravelfeesAction($exportMode = null) {
        $data = $this->request->get();
        $SalaryDetail = new SalaryDetail();
        if(1 == $exportMode){
         $search_result = $SalaryDetail->searchSList($data,0);
         $SalaryDetail->SalaryListExport($search_result,0);
        }
        else{
        $search_result = $SalaryDetail->searchSList($data,1);
        $this->view->disable();
        echo json_encode($search_result);
        }
    }

}
