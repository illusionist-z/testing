<?php

namespace Library\Core;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use workManagiment\Core\Models\Db;

abstract class Utclocaltime extends \Phalcon\Mvc\Controller {

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
    public function aa() {
        echo "bb";
    }

    public function initialize() {
        $this->view->baseUri = $this->url->getBaseUri();
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
    public function beforeExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher) {        // set module          
        if ($this->session->has('language')) {
            $this->lang = $this->session->get('language');
        } else {
            $this->lang = "en";
        }
        $this->moduleName = $dispatcher->getModuleName();
    }

    /**
     * 
     *
     * @return \Phalcon\Translate\Adapter\NativeArray
     */
    protected function _getTranslation() {
        // Check if we have a translation file for that lang
        $langDir = __DIR__ . "/../../apps/{$this->moduleName}/messages";

        if (file_exists($langDir . '/' . $this->lang . '.php')) {
            require $langDir . '/' . $this->lang . '.php';
        } else {
            // fallback to some default
            require $langDir . '/' . "ja.php";
        }

        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
        ));
    }

    /**
     * 
     */

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


        if (file_exists($langDir . '/' . $this->lang . '.php')) {
            require $langDir . '/' . $this->lang . '.php';
        } else {
            // fallback to some default
            require $langDir . '/' . "ja.php";
        }

        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
        ));
    }

}
