<?php

namespace Library\Core;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        * @return int
        */
        public function setPermission() {
        $aryModules = \Library\Core\Module::get();
        //setting permission
        //$coremember = new \salts\Auth\Models\Db\CorePermissionRelMember();
        $coremember = \salts\Auth\Models\Db\CorePermissionRelMember::findByRelMemberId($this->session->user['member_id']);
        if($this->session->user['member_id']){
        $permission_id = $coremember[0]->permission_group_id_user;
        }
            
        $module = $this->router->getModuleName();
        $ctrname=$this->router->getControllerName();
        $actname=$this->router->getActionName();        
        $chksubmenu="";
        $permission="";  
         foreach ($this->session->auth as $name => $value) {
             
                $bigmenu=strtolower($value);
                
                $submenu = explode(" ", $value); 
                if(isset($submenu[1])){
                $chksubmenu = strtolower($submenu[0] . $submenu[1]);
                }
                else{
                $chksubmenu = strtolower($submenu[0]);
                }
                if($actname === $chksubmenu){
                //echo "Equal<br>";
                $permission=1;
               }
               if($module === $bigmenu){                
                $permission=1;
               }               
               if($permission_id === '1'){
                   $permission = 1;
               }
                else {
                    //echo "Not equal";
                    $permission_notequal=0;
                }
               }
        
//        foreach ($this->session->auth as $key_name => $key_value) { 
//            //print_r($key_value).'<br>';
//             $top = explode(" ", $key_value[0]);
//               if (isset($top[1])) 
//                {
//                   $chkmodule= strtolower($top[0] . $top[1]);
//                } else 
//                {
//                 $chkmodule= strtolower($top[0]);
//                }
//                             
//          
//        }
//        echo $permission;
//        exit;
        return $permission;
       
        
       
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
            require $langDir . '/' . $prefix . "ja.php";
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
