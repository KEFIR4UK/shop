<?php

namespace frontend\repositories;

use yii\caching\DbDependency;

class Slider extends \common\models\Slider
{
    public static function getAll()
    {
        return self::getDb()->cache(function ($db) {
            return self::find()->all();
        },
            null,
            new DbDependency(['sql' => sprintf('SELECT MAX(updated_at) FROM %s', self::tableName())])
        );
    }
}