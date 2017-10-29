<?php

namespace shop\useCases\auth;

use common\eventHandlers\user\UserEvent;
use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use shop\repositories\UserRepository;
use yii\base\Component;
use yii\mail\MailerInterface;

class PasswordResetService extends Component
{
    const EVENT_PasswordReset = 'passwordReset';
    private $mailer;
    private $users;

    public function __construct(UserRepository $users, MailerInterface $mailer, array $config = [])
    {
        $this->mailer = $mailer;
        $this->users = $users;
        parent::__construct($config);
    }

    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->users->getByEmail($form->email);

        if (!$user->isActive()) {
            throw new \DomainException('User is not active.');
        }

        $user->requestPasswordReset();
        $this->users->save($user);
        $this->trigger(self::EVENT_PasswordReset, new UserEvent($user));
    }

    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!$this->users->existsByPasswordResetToken($token)) {
            throw new \DomainException('Wrong password reset token.');
        }
    }

    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->users->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->users->save($user);
    }
}