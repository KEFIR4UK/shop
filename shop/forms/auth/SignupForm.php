<?php
namespace shop\forms\auth;

use yii\base\Model;
use shop\entities\User\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $password;

    const PHONE_PATTERN  = '/^0\d{9,9}$/';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class],
            ['phone', 'unique', 'targetClass' => User::class],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['phone', 'required'],
            ['phone', 'match', 'pattern' => self::PHONE_PATTERN],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Імʼя',
            'email' => 'Пошта',
            'password' => 'Пароль',
            'phone' => 'Телефон',
        ];
    }
}
