<?php

namespace App\Admin\Models;

use Phalcon\Mvc\Model;

class Admin extends Model
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
    public $login;

    /**
     *
     * @var string
     */
    public $password;

}
