<?php

use app\components\Migration;

class m240708_091510_create_users_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'access_token' => $this->string(100)->null(),
            ...$this->timestamps(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%users}}');
    }
}
