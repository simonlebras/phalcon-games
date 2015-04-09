<?php

namespace App\Front\Controllers;

class GameController extends BaseController
{
    public function initialize() {
        parent::initialize();
    }
    
    public function indexAction($game)
    {
        $this->view->component = $game;
        $this->view->pick("game/game");
    }

    public function bestAction($game)
    {
        $this->view->disable();
    }

    public function bestsAction()
    {
        $this->view->pick("game/bests");
    }
}