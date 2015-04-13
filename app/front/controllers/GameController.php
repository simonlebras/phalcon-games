<?php

namespace App\Front\Controllers;

use App\Front\Models\Game;
use App\Front\Models\Score;
use Phalcon\Http\Response;

class GameController extends BaseController
{
    public function initialize()
    {
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
        if (!is_array($this->session->get('auth'))) {
            $response = new Response();
            return $response->setStatusCode(401, 'Authentication required');
        }
        if ($this->request->isPost()) {
            $score = Score::findFirst(array(
                'conditions' => 'game = ?1 AND account = ?2',
                'bind' => array(1 => $game, 2 => $this->session->get('auth')['id'])
            ));
            if (!$score) {
                $score = new Score();
            }
            $score->game = $game;
            $score->account = $this->session->get('auth')['id'];
            $score->score = $this->request->getPost('score');
            $response = new Response();
            if ($score->save()) {
                $response->setStatusCode(200, "Best score saved");
            } else {
                $response->setStatusCode(504, "Server error");
            }
        } else if ($this->request->isGet()){
            echo Score::findFirst(array(
                'conditions'=>'game = ?1 AND account = ?2',
                'bind' => array(1 => $game, 2 => $this->session->get('auth')['id'])
            ))->score;
        }
    }

    public function bestsAction()
    {
        $this->view->pick("game/bests");
        $bests = array();
        $games = Game::find(array(
            'conditions' => 'score = 1'
        ));
        foreach ($games as $game) {
            $bests[$game->name] = $game->getScore(array(
                'order' => 'score DESC',
                'limit' => '10'
            ));
        }
        $this->view->bests = $bests;
    }
}