<?php

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini;

error_reporting(E_ALL);
//$debug = new \Phalcon\Debug();
//$debug->listen();

try {

    $loader = new \Phalcon\Loader();
    //Register some namespaces
    $loader->registerDirs(array(
        // set namespace for libraries
        'Library\Core' => __DIR__.'/../library/core/',
        'Library\Core\Plugin' => __DIR__.'/../library/core/plugin', 
        'Library\Core\Models' => __DIR__.'/../library/core/models', 
        
        'salts\Auth\Models' => __DIR__.'../apps/Auth/models/',
        'salts\Auth\Models\Db' => __DIR__.'../apps/Auth/models/db',
        'salts\Core\Models\Db' => __DIR__.'../apps/core/models/db', 
        'salts\Core\Models' => __DIR__.'../apps/core/models',

    ))->register();
    $loader->registerNamespaces(array(
        // set namespace for libraries
        'Library\Core' => __DIR__.'/../library/core/',
        'Library\Core\Plugin' => __DIR__.'/../library/core/plugin',
        'Library\Core\Models' => __DIR__.'/../library/core/models',
        // set namespace for the core module
//        'salts\Core\Controllers' => '../apps/core/controllers/',
        'salts\Core\Models' => __DIR__.'../apps/core/models',
         
        'salts\Auth\Models' => __DIR__.'../apps/Auth/models',
        
        'salts\Core\Models\Db' => __DIR__.'../apps/core/models/db',
        'salts\Auth\Models\Db' => __DIR__.'../apps/Auth/models/db',
//        'salts\Auth\Controllers' => '../apps/auth/controllers/',
    
    ));

    // register autoloader
    $loader->register();

    // get config
    $config = new Ini(__DIR__ . '/../config/org/config.ini');

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
    require __DIR__ . '/../library/core/models/Config.php';
    echo $application->handle()->getContent();
} catch (Phalcon\Exception $e) {
    $logString = $e->getMessage() . " [{$e->getFile()}({$e->getLine()})]" . PHP_EOL
            . "Started Trace" . PHP_EOL . $e->getTraceAsString();
    $di->getShared('logger')->error($logString);

    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
}
