<?php

namespace salts\Auth\Controllers;

use salts\Auth\Models;

class LogoutController extends ControllerBase {

    public function indexAction() {
        $this->session->remove('location');
        $this->session->remove('permission_code');
        $this->session->destroy();
        $this->response->redirect('index/index');
    }
    
    public function gettranslateAction(){
        $t = $this->_getTranslation();
        $data['logout'] = $t->_("logout");
       $this->view->disable();
        echo json_encode($data);

    }

}
