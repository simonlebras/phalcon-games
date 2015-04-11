<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\SigninForm,
    App\Admin\Models\Admin,
    Phalcon\Mvc\Controller,
    Phalcon\Http\Response,
    App\Front\Models\Account;

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

    public function manageAction()
    {
        if (!($this->session->get('admin'))) {
            $response = new Response();
            return $response->redirect('admin/signin');
        }
        $this->view->accounts = Account::find();
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