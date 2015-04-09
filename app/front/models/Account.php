<?php

namespace App\Front\Models;

use  Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Behavior\Timestampable;

use Phalcon\Mvc\Model\Validator\Email as Email;

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
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field' => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

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

}
