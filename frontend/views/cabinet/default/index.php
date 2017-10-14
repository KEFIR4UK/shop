<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати профіль', ['cabinet/profile/edit'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
