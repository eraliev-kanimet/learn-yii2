<?php

use app\components\Migration;

class m240708_091652_create_product_prices_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%product_prices}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'currency_id' => $this->integer()->notNull(),
            'value' => $this->decimal(10, 2)->notNull(),
            ...$this->timestamps(),
        ]);

        $this->addForeignKey('fk_product_price_product', '{{%product_prices}}', 'product_id', '{{%products}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_product_price_currency', '{{%product_prices}}', 'currency_id', '{{%currencies}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown(): void
    {
        $this->dropForeignKey('fk_product_price_product', '{{%product_prices}}');
        $this->dropForeignKey('fk_product_price_currency', '{{%product_prices}}');

        $this->dropTable('{{%product_prices}}');
    }
}
