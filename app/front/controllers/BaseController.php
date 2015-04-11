<?php

namespace App\Front\Controllers;

use App\Front\Models\Game;
use Phalcon\Mvc\Controller;

class BaseController extends Controller
{
    public function initialize() {
        $this->view->games = Game::find();
        $this->view->logged_in = is_array($this->session->get('auth'));
        $this->view->user = $this->session->get('auth');
    }
}
