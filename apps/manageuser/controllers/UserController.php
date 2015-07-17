<?php
namespace workManagiment\Manageuser\Controllers;

class UserController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();        
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/popup.js');  
        $this->assets->addCss('common/css/dialog.css');
    }    
    
    public function userlistAction() {
        $this->view->setVar('type','userlist');
    }
    public function usereditAction() {
        $this->view->setVar('type','useredit');
    }
}

