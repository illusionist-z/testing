<?php

namespace salts\Home\Controllers;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
       
    }

    public function indexAction($mode = NULL) {
        $this->assets->addCss('common/css/home/home.css');

        $user = $this->session->get('user');

        $this->view->user = $user;
    }   
    

}
