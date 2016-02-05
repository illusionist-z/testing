<?php

namespace salts\Salary\Controllers;

use salts\Core\Models\Db;
use salts\Salary\Models\SalaryDetail;
use salts\Salary\Models\SalaryMaster;

class SearchController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('salary');
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
    public function searchTravelfeesAction() {
        $data = $this->request->get();
        $SalaryDetail = new SalaryDetail();
        $search_result = $SalaryDetail->searchSList($data);
        $this->view->disable();
        echo json_encode($search_result);
    }

}
