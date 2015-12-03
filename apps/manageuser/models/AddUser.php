<?php
namespace workManagiment\Manageuser\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Confirmation;

class AddUser extends Model
{
    public function validat($data){
        $res = array();
        $validate = new Validation();
        $validate->add('uname',
                new PresenceOf(
                array(
                    'message' => 'User Name is required'
                     )
                     ));
         $validate->add('work_sdate',
                new PresenceOf(
                array(
                    'message' => 'working start date is required'
                     )
                     ));
        $validate->add('dept',
                new PresenceOf(
                array(
                    'message' => 'Department is required'
                     )
                     ))
                ->add('position',
                new PresenceOf(
                array(
                    'message'=> 'Position is required'
                )));      
        
        $validate->add('password',
                new PresenceOf(
                        array(
                            'message'=>"Password is required"
                        )));
         $validate->add('confirm',
                new Confirmation(
                        array(
                            'with'=>"password",
                            'message'=>"Password is not match"
                        )))
        ->add('confirm',new PresenceOf(array(
            'message' => 'Confirm Password is required'
        )));
        $validate->add('email',
                new Email(
                        array(
                            'message'=>"Email not valid"
                        )));
        $validate ->add('phno', new PresenceOf(array(
        'message' => 'Telephone Number is required',
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
