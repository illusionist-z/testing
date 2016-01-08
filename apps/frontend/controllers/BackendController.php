<?php namespace salts\Frontend\Controllers;

class BackendController extends ControllerBase
{

    public function indexAction()
    {
        $this->response->redirect('auth/index?mode=1');
    }
  
}

