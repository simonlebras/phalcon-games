<?php

namespace App\Front\Controllers;

use App\Front\Models\Account,
    Phalcon\Http\Response,
    App\Front\Forms\SigninForm,
    App\Front\Forms\ManageForm,
    App\Front\Forms\SignupForm,
    Phalcon\Validation\Message;

class AccountController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function signinAction()
    {
        if (is_array($this->session->get('auth'))) {
            $response = new Response();
            return $response->redirect();
        }
        $form = new SigninForm();
        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost())) {
                $form->clear();
                $account = Account::findFirstByLogin($this->request->getPost('login'));
                if ($account && $this->security->checkHash($this->request->getPost('password'), $account->password)) {
                    $this->session->set('auth', array(
                        'id' => $account->id,
                        'login' => $account->login,
                        'file' => $account->file
                    ));
                    $response = new Response();
                    return $response->redirect();
                } else {
                    $this->flash->error('Wrong login/password');
                }
            }
        }
        $this->view->form = $form;
    }

    public function signupAction()
    {
        if (is_array($this->session->get('auth'))) {
            $response = new Response();
            return $response->redirect();
        }
        $form = new SignupForm();
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
                    $this->session->set('auth', array(
                        'id' => $account->id,
                        'login' => $account->login,
                        'file' => $account->file
                    ));
                    $response = new Response();
                    return $response->redirect();
                } else {
                    foreach($account->getMessages() as $message){
                        $this->flash->error($message);
                    }
                }
            }
        }
        $this->view->form = $form;
    }

    public function manageAction()
    {
        if (!is_array($this->session->get('auth'))) {
            $response = new Response();
            return $response->redirect("account/signin");
        }
        if ($this->request->isGet()){
            //$form = new ManageForm(Account::findFirstById($this->session->get('auth')['id']));
            $account = Account::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1=>$this->session->get('auth')['id']),
                'columns' => array('login', 'email')
            ))->getFirst();
            $form = new ManageForm($account);
        }

        else if ($this->request->isPost()) {
            $form = new ManageForm();
            if ($form->isValid($this->request->getPost())) {
                $account = Account::findFirstById($this->session->get('auth')['id']);
                $account->login = $this->request->getPost('login');
                $password = $this->request->getPost('password');
                if (!empty($password)){
                    $account->password = $this->security->hash($password);
                }
                $account->email = $this->request->getPost('email');
                if ($this->request->hasFiles()) {
                    if ($account->file != Account::DEFAULT_AVATAR){
                        unlink($account->file);
                    }
                    $file = $this->request->getUploadedFiles()[0];
                    if (($file->getExtension() == 'jpg') || ($file->getExtension() == 'jpeg') || ($file->getExtension() == 'png')) {
                        $account->file = 'upload/avatar/' . sha1($file->getName() . time()) . '.' . $file->getExtension();
                    } else {
                        $account->file = Account::DEFAULT_AVATAR;
                    }
                }
                $success = $account->update();
                if ($success) {
                    if ($this->request->hasFiles() && $account->file != Account::DEFAULT_AVATAR) {
                        $file->moveTo('../public/' . $account->file);
                    }
                    $this->session->set('auth', array(
                        'id' => $account->id,
                        'login' => $account->login,
                        'file' => $account->file
                    ));
                    $response = new Response();
                    return $response->redirect('account/manage');
                }
            }
        }
        $this->view->form = $form;
    }

    public function logoutAction()
    {
        $this->session->destroy();
        $response = new Response();
        return $response->redirect();
    }
}