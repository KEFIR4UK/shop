<?php

/** @var $products shop\entities\Shop\Product\Product[] */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
?>

<div class="row">
    <?php foreach ($products as $product): ?>
        <?php $url = Url::to(['/shop/catalog/product', 'id' =>$product->id]); ?>
        <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="product-thumb transition">
                <?php if ($product->mainPhoto): ?>
                    <div class="image">
                        <a href="<?= Html::encode($url) ?>">
                            <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>" alt="" class="img-responsive" />
                        </a>
                    </div>
                <?php endif; ?>
                <div>
                    <div class="caption">
                        <h4><a href="<?= Html::encode($url) ?>"><?= Html::encode($product->name) ?></a></h4>
                        <p><?= Html::encode(StringHelper::truncateWords(strip_tags($product->description), 20)) ?></p>
                        <p class="price">
                            <span class="price-new"><?= Yii::$app->formatter->asCurrency($product->price_new) ?></span>
                            <?php if ($product->price_old): ?>
                                <span class="price-old"><?= Yii::$app->formatter->asCurrency($product->price_old) ?></span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
