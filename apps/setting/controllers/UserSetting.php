<?php

use Phalcon\Config;

use Phalcon\Mvc\Url as UrlProvider;

namespace workManagiment\Setting\Controllers; 

use workManagiment\Setting\Models\CoreMember;
 
use workManagiment\Core\Models\Db;

class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
    }
    /**
     * @author Yan Lin Pai <wizardrider@gmail.com>
     *  
     */
      
        public function usersettingAction() {
        }
        
}
