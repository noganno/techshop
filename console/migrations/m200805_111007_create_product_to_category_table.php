<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_to_category}}`.
 */
class m200805_111007_create_product_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_to_category}}', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer(),
            'category_id'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_to_category}}');
    }
}
