<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Lib\Core;

use Phalcon;

Class Module{
    
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
