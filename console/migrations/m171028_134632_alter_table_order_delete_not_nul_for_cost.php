<?php

use yii\db\Migration;

class m171028_134632_alter_table_order_delete_not_nul_for_cost extends Migration
{
    private $tableName = '{{%shop_orders}}';
    private $columnName = 'delivery_cost';

    public function safeUp()
    {
        $this->alterColumn($this->tableName, $this->columnName, $this->integer(11)->null());
    }

    public function safeDown()
    {
        $this->alterColumn($this->tableName, $this->columnName, $this->integer(11)->notNull());
    }
}
