<?php

namespace common\eventHandlers\user\signup;

use common\eventHandlers\user\UserEvent;
use Yii;
use yii\mail\MailerInterface;

class SignUpUserEmailHandler
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
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $event->getUser()]
            )
            ->setTo($event->getUser()->email)
            ->setSubject('Підтвердження реєстрації' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }
}