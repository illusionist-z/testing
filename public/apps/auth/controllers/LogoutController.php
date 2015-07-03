<?php

namespace Crm\Auth\Controllers;

use Crm\Auth\Models;

class LogoutController extends ControllerBase
{

    public function indexAction()
    {
        $this->session->destroy();
    }
    
    

}

