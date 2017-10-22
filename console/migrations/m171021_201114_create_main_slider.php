<?php

use yii\db\Migration;

class m171021_201114_create_main_slider extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%main_slider}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'updated_at' => $this->dateTime()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%main_slider}}');
    }
}
