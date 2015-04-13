<?php

namespace App\Front\Forms;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\TextArea,
    Phalcon\Forms\Element\Submit,
    Phalcon\Validation\Validator\PresenceOf;

class PostForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        //Comment
        $comment = new TextArea('comment');
        $comment->setLabel('Comment');
        $comment->setAttributes(array(
            'class' => 'form-control',
            'id' => 'comment',
            'name' => 'comment',
            'placeholder' => 'Comment',
            'required' => 'true'
        ));
        $comment->addValidators(array(
            new PresenceOf(array(
                'message' => 'Your comment cannot be empty'
            ))
        ));
        $this->add($comment);

        $this->add(new Submit('Submit', array(
            'class' => 'btn btn-success btn-block'
        )));
    }

    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}