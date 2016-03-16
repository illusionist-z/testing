<?php

use Phalcon\Config;

namespace salts\Leavedays\Controllers;

class SearchController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
          $this->module_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->module_name);
        $this->view->permission = $this->permission;
    }

    public function indexAction() {
           if ($this->permission == 1) {
        $ltype = $this->request->get('ltype');
        $month = $this->request->get('month');
        $namelist = $this->request->get('namelist');
        $SearchLeave = new \salts\Leavedays\Models\Leaves();
        $result = $SearchLeave->search($ltype, $month, $namelist);
        $this->view->disable();
        echo json_encode($result);
           }
           else {
               echo 'Page Not Found';
           }
    }

}
