<?php

namespace workManagiment\Auth\Controllers;

use workManagiment\Auth\Models;

class LogoutController extends ControllerBase {

    public function indexAction() {
        $this->session->remove('location');
        $this->session->remove('permission_code');
        $this->session->destroy();
        $this->response->redirect('index/index');
    }

}
