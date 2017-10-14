<?php

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $cartForm shop\forms\Shop\AddToCartForm */
/* @var $reviewForm shop\forms\Shop\ReviewForm */

use frontend\assets\MagnificPopupAsset;
use shop\helpers\PriceHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $product->name;

$this->registerMetaTag(['name' =>'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $product->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
foreach ($product->category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];
$this->params['breadcrumbs'][] = $product->name;

$this->params['active_category'] = $product->category;

MagnificPopupAsset::register($this);
?>

<div class="row" xmlns:fb="http://www.w3.org/1999/xhtml">
    <div class="col-sm-8">
        <ul class="thumbnails">
            <?php foreach ($product->photos as $i => $photo): ?>
                <?php if ($i == 0): ?>
                    <li>
                        <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>">
                            <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>" alt="<?= Html::encode($product->name) ?>" />
                        </a>
                    </li>
                <?php else: ?>
                    <li class="image-additional">
                        <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>" title="HP LP3065">
                            <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" alt="" />
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-description" data-toggle="tab">Опис</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-description"><p>
                <?= Yii::$app->formatter->asHtml($product->description, [
                    'Attr.AllowedRel' => array('nofollow'),
                    'HTML.SafeObject' => true,
                    'Output.FlashCompat' => true,
                    'HTML.SafeIframe' => true,
                    'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <h1><?= Html::encode($product->name) ?></h1>
        <ul class="list-unstyled">
            <li>Бренд: <a href="<?= Html::encode(Url::to(['brand', 'id' => $product->brand->id])) ?>"><?= Html::encode($product->brand->name) ?></a></li>
            <li>Код: <?= Html::encode($product->code) ?></li>
        </ul>
        <ul class="list-unstyled">
            <li>
                <h2><?=Yii::$app->formatter->asCurrency($product->price_new) ?></h2>
            </li>
        </ul>
        <div id="product">

            <?php if ($product->isAvailable()): ?>

                <hr>

                <?php $form = ActiveForm::begin([
                    'action' => ['/shop/cart/add', 'id' => $product->id],
                ]) ?>

                <?php if ($modifications = $cartForm->modificationsList()): ?>
                    <?= $form->field($cartForm, 'modification')->dropDownList($modifications, ['prompt' => '--- Select ---']) ?>
                <?php endif; ?>

                <?= $form->field($cartForm, 'quantity')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Додати', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>

                <?php ActiveForm::end() ?>

            <?php else: ?>

                <div class="alert alert-danger">
                    The product is not available for purchasing right now.<br />Add it to your wishlist.
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>

<?php $js = <<<EOD
$('.thumbnails').magnificPopup({
    type: 'image',
    delegate: 'a',
    gallery: {
        enabled:true
    }
});
EOD;
$this->registerJs($js); ?>



