<?php

namespace App\Front\Controllers;

use App\Front\Models\Account;

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
        if ($this->request->isPost()) {
            $account = new Account();
            $account->login = $this->request->getPost('login');
            $account->password = $this->request->getPost('password');
            $account->email = $this->request->getPost('email');
            if ($this->request->hasFiles()) {
                $files = $this->request->getUploadedFiles();
                $file = $files[0];
                phpinfo();
                echo $file->getExtension();
                /*

                if (($file->getExtension() == 'jpg') || ($file->getExtension() == 'jpeg') || ($file->getExtension() == 'png')) {
                    //$account->file = 'upload/avatar/' . $this->security->hash($file->getName() . time()) . '.' . $file->getExtension();
                } else {
                    $account->file = Account::DEFAULT_AVATAR;
                }*/
            } else {
                $account->file = Account::DEFAULT_AVATAR;
            }
            $success = $account->save();
            if ($success){
                echo "ok";
            } else {
                print_r($account->getMessages());
            }
            $this->view->disable();
        }

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