<?php
use Phalcon\Config;
namespace workManagiment\Leavedays\Controllers;

class ApplyleaveController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();        
    }
    
    public function indexAction(){ 
        require '../apps/leavedays/config/config.php';
        $config=new Config(config);
        var_dump($config->laevetype);exit;
        
        
//        $this->view->setVar("Leavetype", $leavetype);
    }
    public function applyleaveAction() {
        
    }
  
}