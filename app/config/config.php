<?php

$config = new Phalcon\Config(array(
    'database' => array(
        'adapter' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'attsys_db'
    ),
    'phalcon' => array(
        'controllersDir' => '/../app/controllers/',
        'modelsDir' => '/../app/models/',
        'libraryDir' => '/../app/library/',
        'viewsDir' => '/../app/views/',
        'baseUri' => '/workManagiment/'
    ),
    'models' => array(
        'metadata' => array(
            'adapter' => 'Apc',
    		'lifetime' => 86400
        )
    ),
    'office_time' => array(
        'office_start_time' => '08:00:00',
        'office_end_time' => '17:00:00'
        
    ),
    'month' => array(
        '1' => 'January',
        '2' => 'Feburary',
        '3' => 'March',
        '4' => 'Apirl',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'Septemper',
        '10' => 'October',
        '11' => 'Novenber',
        '12' => 'December'
    ),
    
));
