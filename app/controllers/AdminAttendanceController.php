<?php
//include ("functionController.php");

class AdminAttendanceController extends ControllerBase
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

    public function todaylistAction()
    {
         $users=new Users();
         $result=$users->getpermissiongp();
        
         $this->view->setVar("Result", $result);
    
    }

}
