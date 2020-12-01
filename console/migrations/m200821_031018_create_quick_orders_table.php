<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quick_orders}}`.
 */
class m200821_031018_create_quick_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%quick_orders}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'total_amount' => $this->float(),
            'name' => $this->string(),
            'phone' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%quick_orders}}');
    }
}
