<?php

use shop\entities\Shop\Order\Order;
use shop\helpers\OrderHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Замовлення';
$this->params['breadcrumbs'][] = ['label' => 'Особистий кабінет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'created_at:datetime',
                    [
                        'attribute' => 'status',
                        'value' => function (Order $model) {
                            return OrderHelper::statusLabel($model->current_status);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'class' => ActionColumn::class,
                        'template' => '{view}'
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
