<?php
namespace workManagiment\Manageuser\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Regex;

class AddUser extends Model
{
    public function validate($data){
        $res = array();
        $validate = new Validation();
        $validate->add('username',
                new PresenceOf(
                array(
                    'message' => 'The name is required'
                )
            ));
        $validate->add('password',
                new PresenceOf(
                        array(
                            'message'=>"Pass rerru"
                        )));
        $validate->add('email',
                new Email(
                        array(
                            'message'=>"Email not valid"
                        )));
        $validate ->add('phno', new PresenceOf(array(
        'message' => 'The telephone is required',
        'cancelOnFail' => true
        )))
       ->add('phno', new Regex(array(
        'message' => 'The telephone is required',
        'pattern' => '/[0-9]+/'
        ))) ;
        
        $messages = $validate->validate($data);
        if (count($messages)) {
                                foreach ($messages as $message) {
                                     $res[] =$message;
                                }
                              }
    return $res;
    }
}