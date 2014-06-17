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
      'Lib\Core' => '../lib/core/',
    ));

    //register autoloader
    $loader->register();

    //Create a DI
    $di = new \Phalcon\DI\FactoryDefault();

    /**
     * Include services
     */
    require __DIR__ . '/../config/services.php';
    
    
    /**
     * Set up database
     */
    $config = new Ini(__DIR__ . '/../config/config.ini');
    
    $di->set("logger", function() use ($config){
        $file_name = $config->logger->system . 'system_'.date("Ymd").'.log';
        return new \Lib\Core\Logger($file_name);// \Phalcon\Logger\Adapter\File($file_name);
    });
    
    $di->set("db", function() use ($config){
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
                "host" => $config->database->host,
                "username" => $config->database->username,
                "password" => $config->database->password,
                "dbname" => $config->database->dbname
        ));
    });

    
    /**
     * Handle the request
     */
    $application = new Application();

    /**
     * Assign the DI
     */
    $application->setDI($di);
    
    // register di
    \Phalcon\DI::setDefault( $di );
    /**
     * Include modules
     */
    require __DIR__ . '/../config/modules.php';

    echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
}
