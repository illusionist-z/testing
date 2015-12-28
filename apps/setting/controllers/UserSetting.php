<?php

use Phalcon\Config;

use Phalcon\Mvc\Url as UrlProvider;

namespace salts\Setting\Controllers; 

use salts\Setting\Models\CoreMember;
 
use salts\Core\Models\Db;

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
