<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>
    <?php if(Yii::$app->user->isGuest):?>
    <aside id="column-right" class="col-sm-3 hidden-xs">
        <div class="list-group">
            <a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>" class="list-group-item">Увійти</a>
            <a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>" class="list-group-item">Зареєстуватись</a>
            <a href="<?= Html::encode(Url::to(['/auth/reset/request'])) ?>" class="list-group-item">Відновлення паролю</a>
        </div>
    </aside>
    <?php endif;?>
</div>

<?php $this->endContent() ?>
