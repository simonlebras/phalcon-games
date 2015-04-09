<?php

namespace App\Front\Controllers;

use App\Front\Models\Game;
use Phalcon\Mvc\Controller;

class BaseController extends Controller
{
    public function initialize() {
        $this->view->games = Game::find();
    }
}
