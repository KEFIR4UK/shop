<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\widgets\Shop\CartWidget;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]>
<html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]>
<html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en">
<!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
    <link href="<?= Yii::getAlias('@web/images/catalog/cart.png') ?>" rel="icon"/>
    <?php $this->head() ?>
</head>
<body class="common-home">
<?php $this->beginBody() ?>
<nav id="top">
    <div class="container">

        <div id="top-links" class="nav pull-right">
            <ul class="list-inline">
                <li><a href="/index.php?route=information/contact"><i class="fa fa-phone"></i></a>
                    <span class="hidden-xs hidden-sm hidden-md">123456789</span></li>
                <li class="dropdown"><a href="/index.php?route=account/account" title="Особистий кабінет"
                                        class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span
                                class="hidden-xs hidden-sm hidden-md">Особистий кабінет</span> <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <li><a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>">Авторизуватись</a></li>
                            <li><a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>">Зареєструватись</a>
                            </li>
                        <?php else: ?>
                            <li><a href="<?= Html::encode(Url::to(['/cabinet/default/index'])) ?>">Особистий кабінет</a>
                            </li>
                            <li><a href="<?= Html::encode(Url::to(['/auth/auth/logout'])) ?>"
                                   data-method="post">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li><a href="<?= Url::to(['/shop/cart/index']) ?>" title="Корзина"><i
                                class="fa fa-shopping-cart"></i> <span
                                class="hidden-xs hidden-sm hidden-md">Корзина</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="logo">
                    <a href="<?= Url::home() ?>"><img
                                src="<?= Yii::getAlias('@web/image/logo.png') ?>" title="Estel Shop" alt="Estel Shop"
                                class="img-responsive"/></a>
                </div>
            </div>
            <div class="col-sm-5">
                <?= Html::beginForm(['/shop/catalog/search'], 'get') ?>
                <div id="search" class="input-group">
                    <input type="text" name="text" value="" placeholder="Пошук" class="form-control input-lg"/>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                <?= Html::endForm() ?>
            </div>
            <div class="col-sm-3">
                <?= CartWidget::widget() ?>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <?php
    NavBar::begin([
        'options' => [
            'screenReaderToggleText' => 'Menu',
            'id' => 'menu',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'items' => [
            ['label' => 'Головна', 'url' => ['/site/index']],
            ['label' => 'Каталог', 'url' => ['/shop/catalog/index']],
            ['label' => 'Контакти', 'url' => ['/contact/index']],
        ],
    ]);
    NavBar::end();
    ?>
</div>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>
<footer>
    <div class="container">
        <p>Estel-shop &copy; <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
