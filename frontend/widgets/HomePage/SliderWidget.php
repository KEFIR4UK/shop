<?php

namespace frontend\widgets\HomePage;

use frontend\repositories\Slider;
use yii\base\Widget;

class SliderWidget extends Widget
{
    public function run()
    {
        return $this->render('slider', [
            'sliders' => Slider::getAll(),
        ]);
    }
}