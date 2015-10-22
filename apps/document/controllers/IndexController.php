<?php

namespace workManagiment\Document\Controllers;
use workManagiment\Core\Models\Db;
use workManagiment\Document\Models\Document;

class IndexController extends ControllerBase
{
    public $calendar;
    public function initialize() {
        parent::initialize();  
       
        $this->setCommonJsAndCss();
        
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('apps/document/css/index_ssbdocument.css');
        
    }

    
    /**
     * Show ssb document
     * @author zinmon
     */
    public function ssbdocumentAction() {
        $this->assets->addJs('apps/salary/js/print.js');
        $SalaryDetail= new Document();
        $result=$SalaryDetail->getssb_info();
        $this->view->salary_info=$result; 
    }

    public function taxdocumentAction() {
        $this->assets->addJs('apps/salary/js/print.js');
        $SalaryDetail= new Document();
        $result=$SalaryDetail->getsalary_info();
        $this->view->salary_info=$result;
    }
}

