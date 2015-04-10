<?php

namespace App\Admin\Controllers;

use Phalcon\Mvc\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        echo "index action";
    }

    public function userAction()
    {
        echo "user action";
    }

    public function deleteAction()
    {
        echo "delete action";
    }

    public function manageAction()
    {
        echo "manage admin";
    }

    public function signinAction()
    {
        echo "sigin admin";
    }

    public function logoutAction()
    {
        echo "logout admin";
    }
}