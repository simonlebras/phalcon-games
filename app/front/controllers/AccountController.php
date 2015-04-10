<?php

namespace App\Front\Controllers;

use App\Front\Models\Account,
    Phalcon\Http\Response,
    App\Front\Forms\SignUpForm;

class AccountController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function signinAction()
    {
    }

    public function signupAction()
    {
        $form = new SignUpForm();

        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost())) {
                $account = new Account();
                $account->login = $this->request->getPost('login');
                $account->password = $this->security->hash($this->request->getPost('password'));
                $account->email = $this->request->getPost('email');
                if ($this->request->hasFiles()) {
                    $file = $this->request->getUploadedFiles()[0];
                    if (($file->getExtension() == 'jpg') || ($file->getExtension() == 'jpeg') || ($file->getExtension() == 'png')) {
                        $account->file = 'upload/avatar/' . sha1($file->getName() . time()) . '.' . $file->getExtension();
                    } else {
                        $account->file = Account::DEFAULT_AVATAR;
                    }
                } else {
                    $account->file = Account::DEFAULT_AVATAR;
                }
                $success = $account->save();
                if ($success) {
                    if ($account->file != Account::DEFAULT_AVATAR) {
                        $file->moveTo('../public/' . $account->file);
                    }
                    $response = new Response();
                    return $response->redirect();
                }
            }
        }
        $this->view->form = $form;
    }

    public function manageAction()
    {
        echo "manageAction";
    }

    public function logoutAction()
    {
        echo "logoutAction";
    }
}