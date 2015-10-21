<?php

namespace Library\Core;

use Phalcon;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

//use Phalcon\Config\Adapter\Ini;

Class Module implements ModuleDefinitionInterface {

    public $_moduleName;
    public $_moduleDir;

    public function __construct($__DIR__) {
        $this->_moduleDir = $__DIR__;
        $this->_moduleName = ucfirst(basename($__DIR__));
    }

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders(\Phalcon\DiInterface $di = null) {

        $loader = new Loader();

        $loader->registerNamespaces(array(
            'workManagiment\\' . $this->_moduleName . '\Controllers' => $this->_moduleDir . '/controllers/',
            'workManagiment\\' . $this->_moduleName . '\Models' => $this->_moduleDir . '/models/',
            'workManagiment\Auth\Models' =>'C:\xampp\htdocs\workManagiment\apps\auth/models/'                //for permission module language getting in all module
        ));

        $loader->register();
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices(\Phalcon\DiInterface $di) {

        /**
         * Read configuration
         */
//        $config = new Ini($__DIR__ . "/config/config.ini");

        /**
         * Setting up the view component
         */
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir($this->_moduleDir . '/views/');

            return $view;
        };

        $di['dispatcher'] = function() use ($di) {
            //Set Plugin
            $eventsManager = $di->getShared('eventsManager');
            //Set Permission plugin
            $eventsManager->attach('dispatch', new Plugin\Permission($di));

            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setDefaultNamespace('workManagiment\\' . $this->_moduleName . '\Controllers');
            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        };
    }

    /**
     * Get Modules list
     * @return array
     */
    static function get() {
        // Cache the files for 2 days using a Data frontend
        $frontCache = new Phalcon\Cache\Frontend\Data(array(
            "lifetime" => 172800
        ));

        // Create the component that will cache "Data" to a "File" backend
        // Set the cache file directory - important to keep the "/" at the end of
        // of the value for the folder
        $cache = new Phalcon\Cache\Backend\File($frontCache, array(
            "cacheDir" => "../data/cache/core"
        ));
        //print_r($cache);exit;
        // Try to get cached records
        $cacheKey = 'modules.cache';
        //print_r($cache->get($cacheKey));exit;
        $aryModules = $cache->get($cacheKey);
        //print_r($aryModules);exit;
        $aryModules = '';

        if ($aryModules === '') {
            //print_r(array_diff(scandir('apps'),[".",".."]));exit;
            $aryModules = array_diff(scandir('../apps'), [".", ".."]);
            // print_r($aryModules);exit;
            // Store it in the cache
            $cache->save($cacheKey, $aryModules);
        }
        //print_r($aryModules);exit;
        return $aryModules;
    }

}
