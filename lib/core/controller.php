<?php namespace Lib\Core;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use \Crm\Core\Models\Db;

abstract class Controller extends \Phalcon\Mvc\Controller{
    
    public $moduleName;
    
    /**
     * use language
     * 
     * @var type 
     */
    public $lang;
    
    public function initialize() {
        
        
    }
    
    public function beforeExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher){
        // set module
        if(isset($this->session->get('user')['lang'])){
            $this->lang = $this->session->get('user')['lang'];
        }else{
            $this->lang = $this->request->getBestLanguage();
        }
        $this->moduleName = $dispatcher->getModuleName();
    }
    
    /**
     * 
     * @param type $prefix
     * @return \Phalcon\Translate\Adapter\NativeArray
     */
    protected function _getTranslation($prefix = '')
    {
        // Check if we have a translation file for that lang
        $langDir = __DIR__ . "/../../apps/{$this->moduleName}/messages";
        if('' !== $prefix){
            $prefix .= '-';
        }
        
        // 
        if (file_exists($langDir . '/' . $prefix. $this->lang.'.php')) {
           require $langDir . '/' . $prefix . $this->lang.'.php';
        } else {
           // fallback to some default
           require $langDir . '/' . $prefix ."ja.php";
        }

        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
           "content" => $messages
        ));

    }
    
    /**
     * 
     */
    public function setCommonJsAndCss(){
        $this->assets->addCss('css/bootstrap/bootstrap.min.css')
                     ->addCss('css/bootstrap/common.css');
        
        $this->assets->addJs('js/jquery/jquery-1.11.1.min.js')
                     ->addJs('js/jquery/jquery-ui-1.10.4.custom.min.js')
                     ->addJs('js/bootstrap/common.js');
    }
    
    /**
     * using slide menu
     */
    public function useSlideMenu(){
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
        
//        if ($this->_isJsonResponse) {
//            $data = $dispatcher->getReturnedValue();
//            if (is_array($data)) {
//                $data = json_encode($data);
//            }
//            
//            $this->response->setContent($data);
//        }
    }
    
    private function _getCoreTranslation(){
        // Check if we have a translation file for that lang
        $langDir = __DIR__ . "/../../apps/core/messages";
        
        $prefix = 'apps-';
        if (file_exists($langDir . '/' . $prefix. $this->lang.'.php')) {
           require $langDir . '/' . $prefix . $this->lang.'.php';
        } else {
           // fallback to some default
           require $langDir . '/' . $prefix ."ja.php";
        }

        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
           "content" => $messages
        ));
    }
}