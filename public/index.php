<?php

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini;

//error_reporting(E_ALL);
//$debug = new \Phalcon\Debug();
//$debug->listen();

try {

    $loader = new \Phalcon\Loader();
    //Register some namespaces
    $loader->registerDirs(array(
        // set namespace for libraries
        'Library\Core' => __DIR__.'/../library/core/',
       
    ))->register();
    $loader->registerNamespaces(array(
        // set namespace for libraries
        'Library\Core' => __DIR__.'/../library/core/',
        
        // set namespace for the core module
//        'salts\Core\Controllers' => '../apps/core/controllers/',
        'salts\Core\Models' => '../apps/core/models/',
//        'salts\Auth\Controllers' => '../apps/auth/controllers/',
    
    ));

    // register autoloader
    $loader->register();

    // get config
    $config = new Ini(__DIR__ . '/../config/config.ini');

    // Create a DI
    $di = new \Phalcon\DI\FactoryDefault();

    // db set up
    $di->set('db', function() use ($config) {
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname     
        ));
    });
    
    // Include services
    require __DIR__ . '/../config/services.php';

    // Handle the request
    $application = new Application();

    // Assign the DI
    $application->setDI($di);

    // register di
    \Phalcon\DI::setDefault($di);

    // Include modules
    require __DIR__ . '/../config/modules.php';
    /**
     * Module config 
     */
    require __DIR__ . '/../library/core/module_config.php';
    echo $application->handle()->getContent();
} catch (Phalcon\Exception $e) {
    $logString = $e->getMessage() . " [{$e->getFile()}({$e->getLine()})]" . PHP_EOL
            . "Started Trace" . PHP_EOL . $e->getTraceAsString();
    $di->getShared('logger')->error($logString);

    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
}
