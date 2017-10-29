<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Увійти';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            <h2>Новий користувач</h2>
            <p><strong>Створити аккаунт</strong></p>
            <p>Для оформлення замовлення необхідно зареєстуватись</p>
            <a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>" class="btn btn-primary">Продовжити</a>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="well">
            <h2>Увійти</h2>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                Якщо ви забули пароль ви можете <?= Html::a('скинути його', ['auth/reset/request']) ?>.
            </div>

            <div>
                <?= Html::submitButton('Увійти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
