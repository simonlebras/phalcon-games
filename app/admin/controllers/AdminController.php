<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\SigninForm,
    App\Admin\Models\Admin,
    Phalcon\Mvc\Controller,
    Phalcon\Http\Response,
    App\Front\Models\Account;
use App\Front\Models\Post;

class AdminController extends Controller
{

    function initialize()
    {
        $this->view->logged_in = $this->session->get('admin') == true;
    }

    public function indexAction()
    {
    }

    public function deleteAction()
    {
        $this->view->disable();
        if (!($this->session->get('admin'))) {
            $response = new Response();
            return $response->setStatusCode(401, "Authentication required");
        }
        if ($this->request->isPost()) {
            $account = Account::findFirstById($this->request->getPost('id'));
            $response = new Response();
            if ($account) {
                if ($account->delete()) {
                    if ($account->file != Account::DEFAULT_AVATAR) {
                        unlink($account->file);
                    }
                    $response->setStatusCode(200, "Account deleted");
                } else {
                    $response->setStatusCode(504, "Server error");
                }
            } else {
                $response->setStatusCode(404, "Not found");
            }

        }
    }

    public function deletecommentAction()
    {
        $this->view->disable();
        if (!($this->session->get('admin'))) {
            $response = new Response();
            return $response->setStatusCode(401, "Authentication required");
        }
        if ($this->request->isPost()) {
            $post = Post::findFirstById($this->request->getPost('id'));
            $response = new Response();
            if ($post) {
                if ($post->delete()) {
                    $response->setStatusCode(200, "Post deleted");
                } else {
                    $response->setStatusCode(504, "Server error");
                }
            } else {
                $response->setStatusCode(404, "Not found");
            }

        }
    }

    public function manageAction()
    {
        if (!($this->session->get('admin'))) {
            $response = new Response();
            return $response->redirect('admin/signin');
        }
        $this->view->accounts = Account::find();
    }

    public function guestbookAction()
    {
        if (!($this->session->get('admin'))) {
            $response = new Response();
            return $response->redirect('admin/signin');
        }
        $this->view->posts = Post::find();
    }

    public function mapAction()
    {
        if (!($this->session->get('admin'))) {
            $response = new Response();
            return $response->redirect('admin/signin');
        }
        $this->view->map = true;
    }

    public function userslocationAction()
    {
        $this->view->disable();
        if (!($this->session->get('admin'))) {
            $response = new Response();
            return $response->redirect('admin/signin');
        }
        $accounts = Account::find(array(
            'columns' => array('login', 'latitude', 'longitude')
        ));
        $result = array();
        foreach ($accounts as $account) {
            $result[$account->login] = array('latitude' => $account->latitude, 'longitude' => $account->longitude);
        }
        echo json_encode($result);

    }

    public function signinAction()
    {
        if ($this->session->get('admin') == true) {
            $response = new Response();
            return $response->redirect('admin');
        }
        $form = new SigninForm();
        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost())) {
                $form->clear();
                $admin = Admin::findFirstByLogin($this->request->getPost('login'));
                if ($admin && $this->security->checkHash($this->request->getPost('password'), $admin->password)) {
                    $this->session->set('admin', true);
                    $response = new Response();
                    return $response->redirect('admin');
                } else {
                    $this->flash->error('Wrong login/password');
                }
            }
        }
        $this->view->form = $form;
    }

    public function logoutAction()
    {
        $this->session->destroy();
        $response = new Response();
        return $response->redirect('admin');
    }
}