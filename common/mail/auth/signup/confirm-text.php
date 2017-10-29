<?php

/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
Привіт <?= $user->username ?>,

Нижче посилання для підтвердження вашої реєстрації:

<?= $confirmLink ?>
