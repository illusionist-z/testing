<?php

use Phalcon\Config;

namespace workManagiment\Leavedays\Controllers;

class SearchController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
    }
    
    public function indexAction() {
        $ltype = $this->request->get('ltype');
        $month = $this->request->get('month');
        $namelist = $this->request->get('namelist');
        $search_leave = new \workManagiment\Leavedays\Models\Leaves();
        $result=$search_leave->search($ltype,$month,$namelist);
      
       $json['result'] = $result;
      $this->view->disable();
        ;
       echo json_encode($result);
    }

}
