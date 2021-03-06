<?php

/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */
/* @var $model \shop\forms\Shop\Order\OrderForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Замовлення';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="text-left">Назва</td>
                <td class="text-left">Кільіксть</td>
                <td class="text-right">Ціна за одиницю</td>
                <td class="text-right">Загальна</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart->getItems() as $item): ?>
                <?php
                $product = $item->getProduct();
                $modification = $item->getModification();
                $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                ?>
                <tr>
                    <td class="text-left">
                        <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                    </td>
                    <td class="text-left">
                        <?= $item->getQuantity() ?>
                    </td>
                    <td class="text-right"><?=Yii::$app->formatter->asCurrency($item->getPrice()) ?></td>
                    <td class="text-right"><?= Yii::$app->formatter->asCurrency($item->getCost()) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <br />

    <?php $cost = $cart->getCost() ?>
    <table class="table table-bordered">
        <tr>
            <td class="text-right"><strong>Загальна сума:</strong></td>
            <td class="text-right"><?= Yii::$app->formatter->asCurrency($cost->getTotal()) ?></td>
        </tr>
    </table>

    <?php $form = ActiveForm::begin() ?>

    <div class="panel panel-default">
        <div class="panel-heading">Покупець</div>
        <div class="panel-body">
            <?= $form->field($model->customer, 'phone')->textInput() ?>
            <?= $form->field($model->customer, 'name')->textInput() ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Доставка</div>
        <div class="panel-body">
            <?= $form->field($model->delivery, 'method')->dropDownList($model->delivery->deliveryMethodsList(), ['prompt' => '--- Вибрати ---']) ?>
            <?= $form->field($model->delivery, 'address')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Примітка</div>
        <div class="panel-body">
            <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Оформити', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
    
