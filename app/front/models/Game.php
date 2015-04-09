<?php

namespace App\Front\Models;

use  Phalcon\Mvc\Model;

class Game extends Model
{

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $score;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('name', 'Score', 'game', array('alias' => 'Score'));
    }

}
