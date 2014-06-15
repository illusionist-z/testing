<?php

namespace Crm\Test\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
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
}
