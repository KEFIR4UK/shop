<?php

namespace shop\useCases\auth;

use common\eventHandlers\user\UserEvent;
use shop\access\Rbac;
use shop\entities\User\User;
use shop\forms\auth\SignupForm;
use shop\repositories\UserRepository;
use shop\services\RoleManager;
use shop\services\TransactionManager;
use yii\base\Component;
use yii\mail\MailerInterface;

class SignupService extends Component
{
    const EVENT_SignUP = 'signUp';
    private $users;
    private $roles;
    private $transaction;
    private $mailer;

    public function __construct(
        UserRepository $users,
        RoleManager $roles,
        TransactionManager $transaction,
        MailerInterface $mailer,
        array $config = []
    ) {
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
        $this->mailer = $mailer;
        parent::__construct();
    }

    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->phone,
            $form->password
        );
        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
            $this->trigger(self::EVENT_SignUP, new UserEvent($user));
        });
    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }
        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }
}