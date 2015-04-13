<?php

namespace App\Front\Controllers;

use App\Front\Forms\PostForm;
use App\Front\Models\Post;
use Phalcon\Http\Response;

class GuestbookController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function postAction()
    {
        $form = new PostForm();
        $this->view->posts = Post::find();
        if ($this->request->isPost()) {
            if (!is_array($this->session->get('auth'))) {
                $response = new Response();
                return $response->redirect("account/signin");
            }
            if ($form->isValid($this->request->getPost())) {
                $post = new Post();
                $post->comment = $this->request->getPost('comment');
                $post->account = $this->session->get('auth')['id'];
                $success = $post->save();
                if ($success) {
                    $response = new Response();
                    return $response->redirect('guestbook/post');
                } else {
                    foreach($post->getMessages() as $message){
                        $this->flash->error($message);
                    }
                }
            }
        }
        $this->view->form = $form;
    }

}