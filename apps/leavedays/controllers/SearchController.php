<?php

use Phalcon\Config;

namespace salts\Leavedays\Controllers;

class SearchController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        $ltype = $this->request->get('ltype');
        $month = $this->request->get('month');
        $namelist = $this->request->get('namelist');
        $SearchLeave = new \salts\Leavedays\Models\Leaves();
        $result = $SearchLeave->search($ltype, $month, $namelist);
        $this->view->disable();
        echo json_encode($result);
    }

}
