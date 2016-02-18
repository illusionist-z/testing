<?php

namespace salts\Core\Controllers;

use salts\Core\Models\CoreMember;
use salts\Core\Models\Permission;
use Library;
// include_once '/var/www/html/salts/apps/core/models/db/CoreMember.php';
// include_once '/var/www/html/salts/apps/core/models/CoreMember.php';
class IndexController extends Library\Core\Controller {
    
    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {
        $this->setCommonJsAndCss();
    }

    public function setLanguageAction($language = '') {
        if ($language) {
            //set language action
            $member = $this->session->user['member_id'];
            foreach(CoreMember::find("member_id ='$member'") as $lang) {
            $lang->lang = $language;
            $lang->update();
            }
            //get module language action
            $permission = [];
            $Permission = Permission::getInstance()->get($this->session->user, $permission, $language);
            $this->session->set('auth', $Permission);
        }
        //Change the language, reload translations if needed        
        $this->session->set('language', $language);

        //Go to the last place
        $referer = $this->request->getHTTPReferer();
        if (strpos($referer, $this->request->getHttpHost() . "/") !== false) {
            return $this->response->setHeader("Location", $referer);
        } else {
            return $this->dispatcher->forward(array('controller' => 'index', 'action' => 'index'));
        }
    }

}
