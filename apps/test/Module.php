<?php

namespace Crm\Test;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Config\Adapter\Ini;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();
        

        $loader->registerNamespaces(array(
            'Crm\Test\Controllers' => __DIR__ . '/controllers/',
            'Crm\Test\Models' => __DIR__ . '/models/',
        ));

        $loader->register();
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices($di)
    {

        /**
         * Setting up the view component
         */
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');

            return $view;
        };

        
        $di['dispatcher'] = function() {
            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setDefaultNamespace('Crm\Test\Controllers');
            return $dispatcher;
        };

    }

}
