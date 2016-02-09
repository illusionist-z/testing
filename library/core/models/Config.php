<?php

namespace Library\Core\Models;

use Phalcon\Config\Adapter\Ini as Ini;

/**
 * @uses individual module config
 * @param module name,$config data
 * @since 21/7/15
 * @author David
 */

Class Config {
    
    protected static $config = array();

    /**
     * Get Module config
     * @param type $_module
     * @return type
     */
    public static function getModuleConfig($_module) {
        $module_dir_path = __DIR__ . '/../../apps/';
        $ini_file_config = $module_dir_path . $_module . '/config/config.ini';
        
        if (file_exists($ini_file_config)) {
            $Ini = new Ini($ini_file_config);
            return self::$config = $Ini->toArray();
        }
    }
}
