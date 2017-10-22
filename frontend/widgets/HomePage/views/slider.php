<?php
/**@var \frontend\repositories\Slider[] $sliders * */
?>
<div id="slideshow0" class="owl-carousel" style="opacity: 1;">
    <?php foreach ($sliders as $slider): ?>
        <div class="item">
            <a href="#">
                <img
                        src="<?= $slider->getImageFileUrl('name') ?>"
                        alt="" class="img-responsive"/></a>
        </div>
    <?php endforeach; ?>
</div>