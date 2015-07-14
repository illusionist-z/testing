<?php
use Phalcon\Config;
namespace workManagiment\Leavedays\Controllers;

class ApplyleaveController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
        
    }
    public function indexAction() {
         require '../apps/Leavedays/Config/config.php'; 
         $config= $config;
         $leavetype=$config->leavetype;                
        $this->view->setVar("Leavetype", $leavetype);
    }
}