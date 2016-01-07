<?php

namespace salts\Managecompany\Controllers;

use salts\Core\Models\Db\CoreMember;

//use Phalcon\Flash\Direct as FlashDirect;

class IndexController extends ControllerBase {

    public $noti;

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->view->t = $this->_getTranslation();
      $this->assets->addJs('apps/managecompany/js/multiple.js');
    $this->assets->addCss('common/css/css/style.css');
   $this->assets->addCss('common/css/dialog.css');
        
    }
    
    public function indexAction(){
        
    }
    
    public function addcompanyAction(){
        
    }
    
    public function editcompanyAction(){
        
    }

    
}
