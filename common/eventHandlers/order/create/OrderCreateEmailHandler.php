<?php

namespace common\eventHandlers\order\create;

use Yii;
use yii\base\Event;
use yii\mail\MailerInterface;

class OrderCreateEmailHandler
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

    public function handle(Event $event)
    {
        $sent = $this->mailer
            ->compose()
            ->setTo(\Yii::$app->params['adminEmail'])
            ->setTextBody('Прийшло нове замовлення, зайдіть в адмін панель для отримання додаткової інформації')
            ->setSubject('Прийшло нове замовлення' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }
}