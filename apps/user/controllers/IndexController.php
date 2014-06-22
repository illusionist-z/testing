<?php

namespace Crm\User\Controllers;

use Crm\User\Models;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
        $this->assets->addCss('css/user/user.css');
        $this->assets->addJs('js/user/user.js');
        
        $user = $this->session->get('user');
        
        $this->view->depts = Models\Dept::getAll();
        $this->view->user = $user;
        
    }

}

