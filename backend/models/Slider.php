<?php

namespace backend\models;

class Slider extends \common\models\Slider
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                'name',
                'image',
                'extensions' => 'jpg, jpeg, gif, png',
                'on' => [self::SCENARIO_DEFAULT],
                'minWidth' => 1140,
                'maxWidth' => 1140,
                'minHeight' => 380,
                'maxHeight' => 380,
            ],
            [['updated_at'], 'safe'],
        ];
    }
}