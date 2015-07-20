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
    
    public function adduserAction(){
        
        $this->view->setVar('type','userlist');
        if ($this->request->isPost()) {
            $username= $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $dept = $this->request->getPost('dept');
            $position = $this->request->getPost('position');
            $email=$this->request->getPost('email');
            $phno= $this->request->getPost('phno');
            $address= $this->request->getPost('address');
          
            $newuser=new \workManagiment\Core\Models\Db\CoreMember;
            $newuser->addnewuser($username,$password, $dept, $position, $email,$phno,$address);            
            echo "<script type='text/javascript'>window.location.href='applyleave';</script>";
            $this->view->disable();
        } 
    }
}
