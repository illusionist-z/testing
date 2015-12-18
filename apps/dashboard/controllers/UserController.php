<?php

namespace salts\Dashboard\Controllers;
use salts\Core\Models\Db;
//use Phalcon\Flash\Direct as FlashDirect;

class UserController extends  ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/time.js');
        $this->assets->addJs('common/js/btn.js');
        $this->assets->addJs('http://www.geoplugin.net/javascript.gp');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('common/css/boot.css');
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $Admin = new \salts\Auth\Models\Db\CoreMember;
        $id = $this->session->user['member_id'];
//        $this->module_name =  $this->router->getModuleName();        
//        $this->permission = $this->setPermission();             
//        $this->view->module_name=$this->module_name;
//        $this->view->permission = $this->permission;
    }           
    /**
        * 
        *Check User or Admin 
        */
       public function indexAction() {
         
        $User=new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti=$User->GetUserNoti($id);
        $this->view->setVar("noti",$noti);
        $Attendances = new \salts\Dashboard\Models\Attendances();
        $numofatt=$Attendances->getattlist($id);
        $numofleaves=$Attendances->gettotalleaves($id);
        $this->view->setVar("numatt",$numofatt);
        $this->view->setVar("numleaves",$numofleaves);
        $this->view->t = $this->_getTranslation();
        
        
       }
      
    

 
    
}
