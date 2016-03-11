<?php

namespace salts\Manageuser\Controllers;

namespace salts\Manageuser\Controllers;

use Library;

class ControllerBase extends Library\Core\Controller {
    
      public function setManageUserJsAndCss() {
            $this->assets->addCss('common/css/dialog.css');
            $this->assets->addCss('common/css/css/style.css');                        
            $this->assets->addCss('apps/manageuser/css/manageuser.css');
            $this->assets->addJs('apps/manageuser/js/coremember-saveuser.js');
    }
    
}
