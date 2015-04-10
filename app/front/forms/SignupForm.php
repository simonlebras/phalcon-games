<?php

namespace App\Front\Forms;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Submit,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email;

class SignUpForm extends Form
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
            'required'=>'true'
        ));
        $login->addValidators(array(
            new PresenceOf(array(
                'message' => 'The login is required'
            )),
            new StringLength(array(
                'min' => 8,
                'messageMinimum' => 'Login is too short. Minimum 8 characters'
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
            )),
            new StringLength(array(
                'min' => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters'
            ))
        ));
        $this->add($password);

        //Email
        $email = new Text('email');
        $email->setLabel('Email');
        $email->setAttributes(array(
            'class' => 'form-control',
            'id' => 'email',
            'name' => 'email',
            'placeholder' => 'Email',
            'required'=>'true'
        ));
        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'The Email is required'
            )),
            new Email(array(
                'message' => 'The Email is not valid'
            ))
        ));
        $this->add($email);

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