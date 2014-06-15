<?php

/**
 * Register application modules
 */
$application->registerModules(array(
    'frontend' => array(
        'className' => 'Crm\Frontend\Module',
        'path' => __DIR__ . '/../apps/frontend/Module.php'
    ),
    // admin moduleの追加
    'auth' => array(
        'className' => 'Crm\Auth\Module',
        'path'      => __DIR__ . '/../apps/auth/Module.php'
    )
));
