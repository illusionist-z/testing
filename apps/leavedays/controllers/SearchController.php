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
        $ltype=$this->request->get('ltype');
        $month=$this->request->get('month');
        $namelist=$this->request->get('namelist');
        $search_leave = new \workManagiment\Leavedays\Models\Leaves();
        $result=$search_leave->search($ltype,$month,$namelist);
      // print_r(json_decode($result));exit;
       $json['result'] = $result;
      $this->view->disable();
        //return $this->setJsonResponse($json);
        //$this->response->redirect("leavedays/index/leavelist?result=".$result);
        //var_dump(json_decode($result, true));
       echo json_encode($result);
    }
  
}
