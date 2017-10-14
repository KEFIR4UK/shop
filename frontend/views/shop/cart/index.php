<?php

/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="text-center" style="width: 100px">Фото</td>
                    <td class="text-left">Назва</td>
<!--                    <td class="text-left">Model</td>-->
                    <td class="text-left">Кількість</td>
                    <td class="text-right">Ціна за одиницю</td>
                    <td class="text-right">Загалом</td>
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
                        <td class="text-center">
                            <a href="<?= $url ?>">
                                <?php if ($product->mainPhoto): ?>
                                    <img src="<?= $product->mainPhoto->getThumbFileUrl('file', 'cart_list') ?>" alt="" class="img-thumbnail" />
                                <?php endif; ?>
                            </a>
                        </td>
                        <td class="text-left">
                            <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                        </td>
                        <td class="text-left">
                            <?= Html::beginForm(['quantity', 'id' => $item->getId()]); ?>
                            <div class="input-group btn-block" style="max-width: 200px;">
                                <input type="text" name="quantity" value="<?= $item->getQuantity() ?>" size="1" class="form-control" />
                                <span class="input-group-btn">
                                    <button type="submit" title="" class="btn btn-primary" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                                    <a title="Remove" class="btn btn-danger" href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>" data-method="post"><i class="fa fa-times-circle"></i></a>
                                </span>
                            </div>
                            <?= Html::endForm() ?>
                        </td>
                        <td class="text-right"><?= Yii::$app->formatter->asCurrency($item->getPrice()) ?></td>
                        <td class="text-right"><?=Yii::$app->formatter->asCurrency($item->getCost()) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    
    <br />
    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            <?php $cost = $cart->getCost() ?>
            <table class="table table-bordered">
                <?php foreach ($cost->getDiscounts() as $discount): ?>
                <tr>
                    <td class="text-right"><strong><?= Html::encode($discount->getName()) ?>:</strong></td>
                    <td class="text-right"><?= Yii::$app->formatter->asCurrency($discount->getValue()) ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="text-right"><strong>Загальна сума:</strong></td>
                    <td class="text-right"><?= Yii::$app->formatter->asCurrency($cost->getTotal()) ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="buttons clearfix">
        <div class="pull-left"><a href="<?= Url::to('/shop/catalog/index') ?>" class="btn btn-default">Продовжити покупки</a></div>
        <?php if ($cart->getItems()): ?>
            <div class="pull-right"><a href="<?= Url::to('/shop/checkout/index') ?>" class="btn btn-primary">Оформити замовлення</a></div>
        <?php endif; ?>
    </div>
</div>
    
