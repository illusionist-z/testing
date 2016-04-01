<?php

namespace Library\Core;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Core\Models\Db;
 
//use salts\Auth\Models\Db;
abstract class Controller extends \Phalcon\Mvc\Controller {

    public $moduleName;

    /**
     * use language
     * 
     * @var type 
     */
    public $lang;
    public $_isJsonResponse = FALSE;

    /**
     * initialize controller
     */
    public function initialize() {
        $this->view->baseUri = $this->url->getBaseUri();
    }

    /**
     * Set Permission
     * @return int
     */
    public function setPermission($actname) {
        $aryModules = \Library\Core\Module::get();
        $allow = array();
        $permitted = 0;
        //setting permission        
        $coremember = new \salts\Core\Models\CorePermissionRelMember();

        if (null === $this->session->user['member_id']) {
            return false;
        } {
            $core = $coremember::findByRelMemberId($this->session->user['member_id']);
            $permission = $core[0]->permission_group_id_user;
            $coreuser2 = new \salts\Core\Models\CorePermissionGroup();
            $permission_group = $coreuser2->find();
            //get permitted action name

            foreach ($permission_group as $v) {
                $permission === $v->page_rule_group ? $allow[] = $v->permission_code : 0;
            }
            $permission_name = $this->getPermissionCode($allow);
            foreach ($permission_name as $name) {
                $name = strtolower(str_replace(' ', '', $name));
                $name === $actname ? $permitted = 1 : 0;
            }
            return $permitted;
        }
    }

    public function getPermissionCode($code) {
        $setPermission = array();
        $corepermission = new \salts\Core\Models\CorePermission();
        foreach ($code as $c) {
            $temp = $corepermission::findByPermissionCode($c);
            foreach ($temp as $t) {
                $setPermission[] = $t->permission_name_en;
            }
        }
        return $setPermission;
    }

    /**
     * Call this func to set json response enabled
     * @param type $content
     * @return type
     */
    public function setJsonResponse($content) {
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
        $this->response->setJsonContent($content);
        return $this->response;
    }

    /**
     * 
     * @param \Phalcon\Mvc\Dispatcher $dispatcher
     */
    public function beforeExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher) {
        // set module        
        if ($this->session->get('language')) {
            $this->lang = $this->session->get('language');
        } else {
            $this->lang = $this->request->getBestLanguage();
        }
        $this->moduleName = $dispatcher->getModuleName();
    }

    /**
     * 
     * @param type $prefix
     * @return \Phalcon\Translate\Adapter\NativeArray
     */
    protected function _getTranslation($prefix = '') {
        // Check if we have a translation file for that lang
        $langDir = __DIR__ . "/../../apps/{$this->moduleName}/lang";
        $common_lang = __DIR__ . "/../../library/core/lang";
        if ('' !== $prefix) {
            $prefix .= '-';
        }

        if (file_exists($langDir . '/' . $prefix . $this->lang . '.php')) {
            require $langDir . '/' . $prefix . $this->lang . '.php';
            $msg1 = $messages;
            require $common_lang . '/' . $prefix . $this->lang . '.php';
            $message = array_merge($msg1, $messages);
        } else {
            // fallback to some default
            require $langDir . '/' . $prefix . "jp.php";
            $msg1 = $messages;
            require $common_lang . '/' . $prefix . "jp.php";
            $message = array_merge($msg1, $messages);
        }

        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $message
        ));
    }

    /**
     * 
     */
    public function setCommonJsAndCss() {
        $this->assets->addCss('common/css/bootstrap/bootstrap.min.css');
        $this->assets->addCss('common/css/bootstrap.min.css')
                ->addCss('common/css/common.css')
                ->addCss('common/css/jquery-ui.css')
                ->addCss('common/css/skins.min.css');
        $this->assets->addJs('common/js/jquery.min.js')
                ->addJs('common/js/common.js');
        //->addJs('common/js/btn.js')
        $this->assets->addJs('common/js/bootstrap.min.js');
        $this->assets->addJs('common/js/app.min.js');
        $this->assets->addJs('common/js/jquery-ui.js');
        $this->assets->addJs('common/js/notification.js');
        }
    
        public function setAllUse(){
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
        $this->view->t = $this->_getTranslation();
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

                /**
     * Js and Css for attendance list
     */
    public function setAttJsAndCss() {
        $this->assets->addCss('common/css/css/style.css');

        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('apps/attendancelist/js/base.js');
    }

    public function setSettJsAndCss() {
        $this->assets->addJs('apps/setting/js/base.js');
        $this->assets->addJs('apps/setting/js/index-admin.js');
        $this->assets->addJs('apps/setting/js/user-changeprofile.js');
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/css/style.css');
    }

    /**
     * Js and Css for Absent  list
     */
    public function setAttAbsentJsAndCss() {
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/attendancelist/js/absent-addabsent.js');
    }

    /**
     * Js and Css for User attendance list
     */
    public function setAttUserJsAndCss() {
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/attendancelist/js/user-attendancelist.js');
    }

    /**
     * Js and Css for Auth
     */
    public function setAuthJsAndCss() {
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('apps/auth/js/index-forgotpassword.js');
    }

    /**
     * Js and Css for Calendar
     */
    public function setCalJsAndCss() {
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('apps/calendar/css/calendar.css');
        $this->assets->addCss('apps/calendar/css/fullcalendar.min.css');
        $this->assets->addJs('apps/calendar/js/moment.min.js');
        $this->assets->addJs('apps/calendar/js/fullcalendar.min.js');
        $this->assets->addJs('apps/calendar/js/calendar.js');
        $this->assets->addJs('apps/calendar/js/selectall.js');
    }

    /**
     * Js and Css for Document
     */
    public function setDocumentJsAndCss() {
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('apps/document/css/index_ssbdocument.css');
        $this->assets->addJs('apps/document/js/FileSaver.js');
        $this->assets->addJs('apps/document/js/jquery.wordexport.js');
        $this->assets->addJs('apps/document/js/jquery.wordexport.js');
    }

    /**
     * Js and Css for Dashboard
     */
    public function setDashboardJsAndCss() {
        $this->assets->addCss('common/css/bootstrap/bootstrap.min.css');
        $this->assets->addCss('common/css/bootstrap.min.css');
        $this->assets->addCss('common/css/common.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/skins.min.css');
        $this->assets->addJs('common/js/jquery.min.js');
        $this->assets->addJs('common/js/common.js');
        $this->assets->addJs('common/js/bootstrap.min.js');
        $this->assets->addJs('common/js/app.min.js');
        $this->assets->addJs('common/js/jquery-ui.js');
        $this->assets->addJs('common/js/notification.js');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('common/css/boot.css');
        $this->assets->addJs('common/js/time.js');
        $this->assets->addJs('common/js/btn.js');
        $this->assets->addJs('http://www.geoplugin.net/javascript.gp');
        
        
    }

    /**
     * Js and Css for Help
     */
    public function setHelpJsAndCss() {
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('apps/help/css/base.css');
        $this->assets->addJs('apps/help/js/base.js');
    }

    /**
     * Js and Css for Leave Days
     */
    public function setLeaveJsAndCss() {
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('apps/leavedays/js/index-leavesetting.js');
        $this->assets->addJs('apps/leavedays/js/index-leavelist.js');
        $this->assets->addJs('apps/leavedays/js/index-search.js');
        $this->assets->addJs('apps/leavedays/js/index-applyleave.js');
        $this->assets->addJs('common/js/jquery-ui-timepicker.js');
        $this->assets->addCss('common/css/jquery-ui-timepicker.css');
    }

    /**
     * Js and Css for User Leave Days
     */
    public function setUserLeaveJsAndCss() {
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('common/js/export.js');
    }

    /**
     * Js and Css for Manage Company
     */
    public function setCompanyJsAndCss() {
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addJs('apps/managecompany/js/index-base.js');
    }

    /**
     * Js and Css for Manage Company Module Controller
     */
    public function setCompanyModuleJsAndCss() {
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/managecompany/js/module-base.js');
    }

    /**
     * Js and Css for Manage User
     */
    public function setManageUserJsAndCss() {
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('apps/manageuser/js/coremember-saveuser.js');
        $this->assets->addJs('apps/manageuser/css/base.css');
    }

    /**
     * Js and Css for Manage User(Core Member Controller)
     */
    public function setManageUserControllerJsAndCss() {
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addJs('apps/manageuser/js/base.js');
    }

    /**
     * Js and Css for Salary
     */
    public function setSalaryJsAndCss() {
        $this->assets->addCss('apps/salary/css/base.css');
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('common/js/export.js');
    }

    /**
     * Js and Css for Setting
     */
    public function setSettingJsAndCss() {
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('apps/setting/js/base.js');
        $this->assets->addJs('apps/setting/js/index-admin.js');
    }

    public function setNotificationJsAndCss() {
        $this->assets->addJs('common/js/jquery-ui.js');
    }

    /**
     * using slide menu
     */
    public function useSlideMenu() {
        $this->assets->addJs('lib/mmenu/js/jquery.mmenu.min.js');
        $this->assets->addCss('lib/mmenu/css/jquery.mmenu.css');
        $this->assets->addJs('js/bootstrap/slide-menu.js');
        // Get application list
        $this->view->coreAppsTran = $this->_getCoreTranslation();
        $dbCoreApps = new Db\CoreApps();
        $this->view->menulist = $dbCoreApps->getActiveApps($this->session->get('auth'));
//        $this->view->menulist = \Crm\Core\Models\Db\CoreApps::find()->toArray();
//        $this->view->slideMenus = $this->view
//                ->setViewsDir(realpath(__DIR__.'/../../apps/core/views'))
//                ->pick("index/cmn-slide-menu");
//        $this->view->setPartialsDir($partialsDir)->pick($renderView);
    }

    // After route executed event
    public function afterExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher) {
        
    }

    private function _getCoreTranslation() {
        // Check if we have a translation file for that lang
        $langDir = __DIR__ . "/../../apps/core/messages";
        $prefix = 'apps-';
        if (file_exists($langDir . '/' . $prefix . $this->lang . '.php')) {
            require $langDir . '/' . $prefix . $this->lang . '.php';
        } else {
            // fallback to some default
            require $langDir . '/' . $prefix . "jp.php";
        }
        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
        ));
    }

}
