<?php

namespace shop\forms\Shop\Order;

use shop\forms\auth\SignupForm;
use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $name;

    public function rules(): array
    {
        return [
            [['phone', 'name'], 'required'],
            ['phone', 'match', 'pattern' => SignupForm::PHONE_PATTERN],
            [['phone', 'name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'name' => 'Імʼя',
        ];
    }
}