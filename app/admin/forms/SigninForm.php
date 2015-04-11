<?php

namespace App\Admin\Forms;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Submit,
    Phalcon\Validation\Validator\PresenceOf;

class SigninForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        //Login
        $login = new Text('login');
        $login->setLabel('Login');
        $login->setAttributes(array(
            'class' => 'form-control',
            'id' => 'login',
            'name' => 'login',
            'placeholder' => 'Login',
            'required'=>'true',
            'autofocus' => 'true'
        ));
        $login->addValidators(array(
            new PresenceOf(array(
                'message' => 'The login is required'
            ))
        ));
        $this->add($login);

        //Password
        $password = new Password('password');
        $password->setLabel('Password');
        $password->setAttributes(array(
            'class' => 'form-control',
            'id' => 'password',
            'name' => 'password',
            'placeholder' => 'Password',
            'required'=>'true'
        ));
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'The password is required'
            ))
        ));
        $this->add($password);

        $this->add(new Submit('Submit', array(
            'class' => 'btn btn-success btn-block'
        )));
    }

    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}