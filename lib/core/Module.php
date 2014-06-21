<?php namespace Lib\Core;

use Phalcon;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
//use Phalcon\Config\Adapter\Ini;

Class Module implements ModuleDefinitionInterface{
    
    public $_moduleName;
    
    public $_moduleDir;
    
    public function __construct($__DIR__) {
        $this->_moduleDir = $__DIR__;
        $this->_moduleName = ucfirst(basename($__DIR__));
    }


    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(array(
            'Crm\\' . $this->_moduleName . '\Controllers' => $this->_moduleDir . '/controllers/',
            'Crm\\' . $this->_moduleName . '\Models' => $this->_moduleDir . '/models/',
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
        
        $di['dispatcher'] = function() use ($di){
            //Set Plugin
            $eventsManager = $di->getShared('eventsManager');
            //Set Permission plugin
            $eventsManager->attach('dispatch', new Plugin\Permission($di));
            
            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setDefaultNamespace('Crm\\'.$this->_moduleName.'\Controllers');
            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        };

    }
    
    /**
     * Get Modules list
     * @return array
     */
    static function get(){
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

        // Try to get cached records
        $cacheKey = 'modules.cache';
        $aryModules    = $cache->get($cacheKey);
        if ($aryModules === null) {
            $aryModules = array_diff(scandir('../apps'),[".",".."]);

            // Store it in the cache
            $cache->save($cacheKey, $aryModules);
        }
        return $aryModules;
    }
}
