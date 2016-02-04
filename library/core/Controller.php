<?php

namespace Library\Core;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Core\Models;
use salts\Core\Models\Db;

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
     * @param type $actname
     * @return int|boolean
     */
    public function setPermission($actname) {
        if (NULL === $this->session->user['member_id']) {
            return false;
        }

        $allow = array();
        $permitted = 0;
        //setting permission        
        $CoreMember = Models\CorePermissionRelMember::getInstance();

        $core = $CoreMember::findByRelMemberId($this->session->user['member_id']);
        $permission = $core[0]->permission_group_id_user;

        $CorePermissionGroup = Models\CorePermissionGroup::getInstance();
        $permission_group = $CorePermissionGroup->find();
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

    /**
     * Get permission code
     * @param type $code
     * @return typeå
     */
    public function getPermissionCode($code) {
        $setPermission = array();
        $corepermission = Models\CorePermission::getInstance();
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
        $langDir = __DIR__ . "/../../apps/{$this->moduleName}/messages";
        if ('' !== $prefix) {
            $prefix .= '-';
        }

        // 
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

    /**
     * 
     */
    public function setCommonJsAndCss() {
        $this->assets->addCss('common/css/bootstrap/bootstrap.min.css')
                ->addCss('common/css/bootstrap.min.css')
                ->addCss('common/css/common.css')
                ->addCss('common/css/jquery-ui.css')
                ->addCss('common/css/skins.min.css');


        $this->assets->addJs('common/js/jquery.min.js')
                ->addJs('common/js/common.js')
                //->addJs('common/js/btn.js')
                ->addJs('common/js/bootstrap.min.js')
                ->addJs('common/js/app.min.js')
                ->addJs('common/js/jquery-ui.js')
                ->addJs('common/js/notification.js');
    }

    public function setNotificationJsAndCss() {

        $this->assets
                //->addJs('common/js/jquery.min.js')
                //->addJs('common/js/common.js')
                //->addJs('common/js/jQuery-2.1.4.min.js')
                //->addJs('common/js/bootstrap.min.js')
                //->addJs('common/js/app.min.js')
                ->addJs('common/js/jquery-ui.js');
        //->addJs('common/js/notification.js');
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
            require $langDir . '/' . $prefix . "ja.php";
        }

        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
        ));
    }

}
