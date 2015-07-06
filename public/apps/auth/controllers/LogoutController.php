<?php

namespace Workmanagements\Auth\Controllers;

use Workmanagements\Auth\Models;

class LogoutController extends ControllerBase
{

    public function indexAction()
    {
        $this->session->destroy();
    }
    
    

}

