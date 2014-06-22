<?php namespace Lib\Core;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
abstract class Controller extends \Phalcon\Mvc\Controller{
    
    public function initialize() {
        $this->view->lang = $this->request->getBestLanguage();
    }
    
    protected function _getTranslation()
    {

        //Check if we have a translation file for that lang
        if (file_exists("app/auth/messages/".$this->view->lang.".php")) {
           require "app/auth/messages/".$this->view->lang.".php";
        } else {
           // fallback to some default
           require "app/auth/messages/ja.php";
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
    
    protected $_isJsonResponse = false;

    // Call this func to set json response enabled
    public function setJsonResponse() {
      $this->view->disable();

      $this->_isJsonResponse = true;
      $this->response->setContentType('application/json', 'UTF-8');
    }

    // After route executed event
    public function afterExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher) {
        if ($this->_isJsonResponse) {
            $data = $dispatcher->getReturnedValue();
            if (is_array($data)) {
                $data = json_encode($data);
            }
            
            $this->response->setContent($data);
        }
    }
}