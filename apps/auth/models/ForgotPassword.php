<?php

namespace salts\Auth\Models;

use Phalcon\Mvc\Model;

/**
 * @author Saw Zin Min Tun <> <sawzinminmin@gmail.com> 
 */
class ForgotPassword extends Model {

    public $check_mail;
    public $token;

}
