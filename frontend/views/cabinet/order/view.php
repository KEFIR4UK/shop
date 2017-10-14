<?php

use shop\helpers\OrderHelper;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order shop\entities\Shop\Order\Order */

$this->title = 'Замовлення ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Особитий кабінет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $order,
        'attributes' => [
            'created_at:datetime',
            [
                'attribute' => 'current_status',
                'value' => OrderHelper::statusLabel($order->current_status),
                'format' => 'raw',
            ],
            'delivery_method_name',
            'deliveryData.index',
            'deliveryData.address',
            'cost',
        ],
    ]) ?>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-left">Назва</th>
                <th class="text-left">Кількість</th>
                <th class="text-right">Ціна за одиницю</th>
                <th class="text-right">Загальна</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->items as $item): ?>
                <tr>
                    <td class="text-left">
                        <?= Html::encode($item->product_name) ?>
                    </td>
                    <td class="text-left">
                        <?= $item->quantity ?>
                    </td>
                    <td class="text-right"><?=Yii::$app->formatter->asCurrency($item->price) ?></td>
                    <td class="text-right"><?= Yii::$app->formatter->asCurrency($item->getCost()) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>