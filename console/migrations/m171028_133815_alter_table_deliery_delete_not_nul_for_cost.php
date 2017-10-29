<?php

use yii\db\Migration;

class m171028_133815_alter_table_deliery_delete_not_nul_for_cost extends Migration
{
    private $tableName = '{{%shop_delivery_methods}}';
    private $columnName = 'cost';

    public function safeUp()
    {
        $this->alterColumn($this->tableName, $this->columnName, $this->integer(11)->null());
    }

    public function safeDown()
    {
        $this->alterColumn($this->tableName, $this->columnName, $this->integer(11)->notNull());
    }
}
