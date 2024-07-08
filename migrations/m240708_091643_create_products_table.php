<?php

use app\components\Migration;

class m240708_091643_create_products_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            ...$this->timestamps(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%products}}');
    }
}
