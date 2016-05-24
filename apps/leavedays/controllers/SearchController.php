<?php

namespace salts\Leavedays\Controllers;

class SearchController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->module_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->module_name);
        $this->view->permission = $this->permission;
    }

    public function indexAction($exportMode = null) {
        if ($this->permission == 1) {
            $ltype = $this->request->get('ltype');
            $month = $this->request->get('month');
            $namelist = $this->request->get('namelist');
            $page = $this->request->get("page");
            $SearchLeave = new \salts\Leavedays\Models\Leaves();
            $max = $SearchLeave->getLeaveSetting();
            if (1 == $exportMode) {
                $result = $SearchLeave->search($ltype, $month, $namelist, $page, 0);
                $SearchLeave->exportUserLeaveList($result, "Leave List", $SearchLeave->getAbsent(), $max['0']['max_leavedays'],0);
            } else {
                $result = $SearchLeave->search($ltype, $month, $namelist, $page, 1);
                $this->view->disable();
                echo json_encode($result);
            }
        } else {
            echo 'Page Not Found';
        }
    }

}
