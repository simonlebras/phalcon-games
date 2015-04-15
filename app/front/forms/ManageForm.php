<?php

namespace App\Front\Forms;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Submit,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email,
    Phalcon\Validation\Validator\Regex;

class ManageForm extends Form
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
            'required' => 'true'
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
            'required' => 'true'
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
            'required' => 'true'
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

        //Latitude
        $latitude = new Text('latitude');
        $latitude->setLabel('Latitude');
        $latitude->setAttributes(array(
            'class' => 'form-control',
            'id' => 'latitude',
            'name' => 'latitude',
            'placeholder' => 'Latitude',
            'required' => 'true'
        ));
        $latitude->addValidators(array(
            new PresenceOf(array(
                'message' => 'The latitude is required'
            )),
            new Regex(array(
                'pattern' => '/^(\-?\d{1,3}(\.\d+)?)$/',
                'message' => 'The latitude is invalid'
            ))
        ));
        $this->add($latitude);

        //Longitude
        $longitude = new Text('longitude');
        $longitude->setLabel('Longitude');
        $longitude->setAttributes(array(
            'class' => 'form-control',
            'id' => 'longitude',
            'name' => 'longitude',
            'placeholder' => 'Longitude',
            'required' => 'true'
        ));
        $longitude->addValidators(array(
            new PresenceOf(array(
                'message' => 'The longitude is required'
            )),
            new Regex(array(
                'pattern' => '/^(\-?\d{1,3}(\.\d+)?)$/',
                'message' => 'The longitude is invalid'
            ))
        ));
        $this->add($longitude);

        $this->add(new Submit('Submit', array(
            'class' => 'btn btn-success btn-block'
        )));
    }

    function beforeValidation($data, $entity)
    {
        $elements = $this->getElements();
        if (isset($data['password']) && !empty($data['password'])) {
            $elements['password']->addValidator(new StringLength(array(
                'min' => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters'
            )));
        }
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