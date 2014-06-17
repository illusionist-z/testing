<?php

namespace Crm\Auth\Controllers;

use Crm;
class LoginController extends ControllerBase
{

    
    public function indexAction()
    {
        $login = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        $this->view->test = Crm\Auth\Models\Db\CoreUser::findFirstByLogin($login);
    }
    
    

}

