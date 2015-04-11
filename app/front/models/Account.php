<?php

namespace App\Front\Models;

use  Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Behavior\Timestampable,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Account extends Model
{
    const DEFAULT_AVATAR = "img/default_avatar.png";

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $login;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $file;

    /**
     *
     * @var string
     */
    public $account_creation;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Score', 'account', array('alias' => 'Score'));
        $this->addBehavior(new Timestampable(array(
            'beforeValidationOnCreate' => array(
                'field' => 'account_creation',
                'format' => 'Y-m-d'
            )
        )));
    }

    public function validation()
    {
        $this->validate(new Uniqueness(array(
            'field' => 'login',
            'message' => 'This login is already used'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

}
