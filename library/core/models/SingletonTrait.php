<?php

namespace Library\Core\Models;

/**
 * If you want to use singleton instance,
 * use this trait
 *
 * @author Kohei Iwasa <kiwasa@gnext.co.jp>
 * @since 2015/07/15
 */
trait SingletonTrait {

    /**
     * @var this Singleton instance
     */
    private static $instance;

    /**
     * Retrieve singleton instance
     *
     * @return this
     */
    public static function getInstance() {
        if (FALSE === isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
