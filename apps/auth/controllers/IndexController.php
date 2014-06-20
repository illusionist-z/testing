<?php

namespace Crm\Auth\Controllers;

class IndexController extends ControllerBase
{

    
    public function indexAction()
    {
        $this->assets
             ->addCss('./css/auth/auth.css');
        
        $this->view->lang = $this->request->getBestLanguage();
        $this->view->test = $this->test();
    }
    
    

}

