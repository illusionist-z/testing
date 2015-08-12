<?php
//include ("functionController.php");

class AdminsController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Gnext attendance system');
        parent::initialize();
        if(!isset($this->session->auth['user_role'])){
            header ("Location: ../index");
            }
    }

    public function indexAction()
    {
          
    
    }

}
