<?php

/**
 * Register application modules
 */
$application->registerModules(array(
    'frontend' => array(
        'className' => 'Workmanagements\Frontend\Module',
        'path' => __DIR__ . '/../apps/frontend/Module.php'
    )
));
