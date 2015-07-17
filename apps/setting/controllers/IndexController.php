<?php

use Phalcon\Config;
namespace workManagiment\Setting\Controllers;
use workManagiment\Core\Models\Db;
class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        //$this->assets->addCss('common/css/home/home.css');        
        
        //$this->response->redirect('applyleave');        
    }
    public function settingmoduleAction() {
        $userlist=new Db\CoreMember();
        $username = $userlist::getinstance()->getusername();
        $this->view->setVar("member",$username);
    }
 
        
     
        
   
  
}
