<?php namespace Lib\Core;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Controller extends \Phalcon\Mvc\Controller{
    
    protected function _getTranslation()
    {

        //Ask browser what is the best language
        $language = $this->request->getBestLanguage();

        //Check if we have a translation file for that lang
        if (file_exists("app/auth/messages/".$language.".php")) {
           require "app/auth/messages/".$language.".php";
        } else {
           // fallback to some default
           require "app/auth/messages/ja.php";
        }

        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
           "content" => $messages
        ));

    }
    
    public function test(){
        return 'extends test!!';
    }
}