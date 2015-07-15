<?php

use Phalcon\Config;

namespace workManagiment\Leavedays\Controllers;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        //$this->assets->addCss('common/css/home/home.css');        
        $user = $this->session->get('user');
        //$this->response->redirect('applyleave');        
    }

    public function applyleaveAction() {        
        require '../apps/Leavedays/Config/config.php';
        $config = $config;
        $leavetype = $config->leavetype;
        $this->view->setVar("Leavetype", $leavetype);
        if ($this->request->isPost()) {
            $sdate = $this->request->getPost('sdate');
            $edate = $this->request->getPost('edate');
            $type = $this->request->getPost('leavetype');
            $desc = $this->request->getPost('description');
            $id   = $this->session->user['member_id'];
            $applyleave = new \workManagiment\Leavedays\Models\Leave();
            $applyleave->applyleave($id,$sdate, $edate, $type, $desc);            
            echo "<script type='text/javascript'>window.location.href='applyleave';</script>";
            $this->view->disable();
        }     
        
    }

}
