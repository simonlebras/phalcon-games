<?php

namespace App\Admin\Controllers;

use Phalcon\Mvc\Controller;

class ErrorController extends Controller
{
    public function show404Action()
    {
        $this->response->setStatusCode(404, 'Not Found');
        $this->view->pick('404/404');
    }

    public function show503Action()
    {
        $this->response->setStatusCode(503, 'Server Error');
        $this->view->pick('503/503');
    }
}