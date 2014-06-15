<?php

namespace Crm\Auth\Controllers;

class IndexController extends ControllerBase
{

    
    public function indexAction()
    {
        $this->view->lang = $this->request->getBestLanguage();
    }
    
    

}

