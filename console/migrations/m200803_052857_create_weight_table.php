<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%weight}}`.
 */
class m200803_052857_create_weight_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weight}}', [
            'id' => $this->primaryKey(),
            'unit'=>$this->string(50),
            'value'=>$this->decimal(10,4)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weight}}');
    }
}
