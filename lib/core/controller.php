<?php namespace Lib\Core;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Controller extends \Phalcon\Mvc\Controller{
    
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
    }
}