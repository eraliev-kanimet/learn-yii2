<?php

use app\components\Migration;

class m240708_091725_create_purchases_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%purchases}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'phone' => $this->string(20)->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'payment_status' => $this->boolean()->notNull()->defaultValue(false),
            ...$this->timestamps(),
        ]);

        $this->addForeignKey('fk_purchase_product', '{{%purchases}}', 'product_id', '{{%products}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown(): void
    {
        $this->dropForeignKey('fk_purchase_product', '{{%purchases}}');

        $this->dropTable('{{%purchases}}');
    }
}
