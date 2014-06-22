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
        
        //set duser info
        $this->view->user = $this->session->get('user');
        
        //set dept list
        $this->view->depts = Models\Dept::getAll();
        
    }
    
}

