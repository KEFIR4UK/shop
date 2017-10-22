<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "{{%main_slider}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $updated_at
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%main_slider}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'name',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/sliders/[[attribute_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/sliders/[[attribute_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/sliders/[[attribute_id]]/[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/sliders/[[attribute_id]]/[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                ],
            ],
        ];
    }
}
