<?php

namespace App\Front\Models;

use  Phalcon\Mvc\Model;

class Score extends Model
{

    /**
     *
     * @var string
     */
    public $game;

    /**
     *
     * @var integer
     */
    public $account;

    /**
     *
     * @var integer
     */
    public $score;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('account', 'App\Front\Models\Account', 'id', array('alias' => 'Account'));
        $this->belongsTo('game', 'App\Front\Models\Game', 'name', array('alias' => 'Game'));
    }

}
