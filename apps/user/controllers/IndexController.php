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
        $this->assets->addJs('lib/mmenu/js/jquery.mmenu.min.js');
        $this->assets->addCss('lib/mmenu/css/jquery.mmenu.css');
        
        $this->assets->addCss('css/user/user.css');
        $this->assets->addJs('js/user/user.js');
         
        //set duser info
        $this->view->user = $this->session->get('user');
        $this->view->tran = $this->_getTranslation();
        
        //set dept list
        $this->view->depts = Models\Dept::getAll();
        
    }
    
}
