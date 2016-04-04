<?php

namespace salts\Core\Controllers;

use salts\Core\Models\CoreMember;
use salts\Core\Models\Db;
use salts\Core\Models\Permission;
use Library;

class IndexController extends Library\Core\Controller {
    
    public function initialize() {
        parent::initialize();
        
          $this->setCommonJsAndCss();
           $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays');
        $Admin = new Db\CoreMember();
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $noti = $Admin->GetAdminNoti($this->session->user['member_id'], 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $Admin->GetUserNoti($this->session->user['member_id'], 1);
            }
        }
        $this->view->setVar("Noti", $noti);
        $this->view->module_name = $this->router->getModuleName();
         
        $this->permission = $this->setPermission($this->router->getModuleName());
        $this->view->permission = $this->permission;
        $moduleIdCallCore = new Db\CoreMember();
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->router->getModuleName(), $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
       // Module ID Filter Start By (Module Name)        
        $this->view->module_name_view = $this->module_name;
        $this->module_id_set = $this->session->module;
        $this->view->module_id_set = $this->module_id_set;
    }

    public function indexAction() {
      
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
