<?php

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\User\UserEditForm */
/* @var $user shop\entities\User\User */

use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Редагування профілю';
$this->params['breadcrumbs'][] = ['label' => 'Особистий кабінет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = 'Профіль';
?>
<div class="user-update">

    <div class="row">
        <div class="col-sm-6">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
            <?= $form->field($model, 'phone', ['addon' => ['prepend' => ['content'=>'+']]])->textInput(['maxLength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
