<?php

namespace shop\forms;

use Yii;
use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Код перевірки',
            'name' => 'Імʼя',
            'email' => 'Пошта',
            'subject' => 'Тема',
            'body' => 'Повідомлення',
        ];
    }
}
