<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
<div class="password-reset">
    <p>Привіт <?= Html::encode($user->username) ?>,</p>

    <p>Нижче посилання для підтвердження вашої реєстрації:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>
