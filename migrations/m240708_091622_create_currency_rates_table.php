<?php

use app\components\Migration;

class m240708_091622_create_currency_rates_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%currency_rates}}', [
            'id' => $this->primaryKey(),
            'currency_id' => $this->integer()->notNull(),
            'rate' => $this->decimal(10, 4)->notNull(),
            ...$this->timestamps(),
        ]);

        $this->addForeignKey('fk_currency_rate_currency', '{{%currency_rates}}', 'currency_id', '{{%currencies}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown(): void
    {
        $this->dropForeignKey('fk_currency_rate_currency', '{{%currency_rates}}');

        $this->dropTable('{{%currency_rates}}');
    }
}
