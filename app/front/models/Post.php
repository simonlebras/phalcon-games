<?php

namespace App\Front\Models;

use  Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Behavior\Timestampable;

class Post extends Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $comment;

    /**
     *
     * @var string
     */
    public $date_comment;

    /**
     *
     * @var integer
     */
    public $account;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('account', 'App\Front\Models\Account', 'id', array('alias' => 'Account'));
        $this->addBehavior(new Timestampable(array(
            'beforeValidationOnCreate' => array(
                'field' => 'date_comment',
                'format' => 'Y-m-d'
            )
        )));
    }

}
