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
        require '../apps/Leavedays/config/config.php';
        $config=new Config($config);
        var_dump($config);exit;
        
        
//        $this->view->setVar("Leavetype", $leavetype);
    }
    public function applyleaveAction() {
        
    }
  
}