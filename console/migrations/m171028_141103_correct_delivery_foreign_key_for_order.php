<?php

use yii\db\Migration;

class m171028_141103_correct_delivery_foreign_key_for_order extends Migration
{
    public function up()
    {
        $this->dropForeignKey('{{%fk-shop_orders-delivery_method_id}}', '{{%shop_orders}}');

        $this->addForeignKey(
            '{{%fk-shop_orders-delivery_method_id}}',
            '{{%shop_orders}}',
            'delivery_method_id',
            '{{%shop_delivery_methods}}',
            'id',
            'RESTRICT'
        );
    }

}
