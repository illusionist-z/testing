<?php

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini;

error_reporting(E_ALL);

//$debug = new \Phalcon\Debug();
//$debug->listen();

try {
    
    //Register an autoloader
    $loader = new \Phalcon\Loader();
    //Register some namespaces
    $loader->registerNamespaces(array(
      // set namespace for libraries
      'Library\Core' => '../library/core/',
      
      // set namespace for the core module
      'workManagiment\Core\Controllers' => '../apps/core/controllers/',
      'workManagiment\Core\Models' => '../apps/core/models/',
    ));

    //register autoloader
    $loader->register();

    //get config
    $config = new Ini(__DIR__ . '/../config/config.ini');
    
    //Create a DI
    $di = new \Phalcon\DI\FactoryDefault();

    /**
     * Include services
     */
    require __DIR__ . '/../config/services.php';
      
    /**
     * Handle the request
     */
    $application = new Application();

    /**
     * Assign the DI
     */
    $application->setDI($di);
    
    // register di
    \Phalcon\DI::setDefault($di);
    
    /**
     * Include modules
     */
    require __DIR__ . '/../config/modules.php';
    
    echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
    $logString = $e->getMessage()." [{$e->getFile()}({$e->getLine()})]".PHP_EOL
               . "Started Trace".PHP_EOL . $e->getTraceAsString();
    $di->getShared('logger')->error($logString);
    
    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
}
