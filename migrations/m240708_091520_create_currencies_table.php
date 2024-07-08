<?php

use app\components\Migration;

class m240708_091520_create_currencies_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%currencies}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(6)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            ...$this->timestamps(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%currencies}}');
    }
}
