<?php

namespace common\eventHandlers\user\resetPassword;

use common\eventHandlers\user\UserEvent;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetUserEmailHandler
{
    private $mailer;

    /**
     * SignUpUserEmailHandler constructor.
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param UserEvent $event
     * @throws \RuntimeException
     */
    public function handle(UserEvent $event)
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/reset/confirm-html', 'text' => 'auth/reset/confirm-text'],
                ['user' => $event->getUser()]
            )
            ->setTo($event->getUser()->email)
            ->setSubject('Відновення паролю ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }
}