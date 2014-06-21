<?php

namespace Crm\Test\Controllers;

class IndexController extends ControllerBase
{
    
    public function indexAction()
    {
        
        $this->view->lang = $this->request->getBestLanguage();
    }

}

