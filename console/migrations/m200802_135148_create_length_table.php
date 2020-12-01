<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%length}}`.
 */
class m200802_135148_create_length_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%length}}', [
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
        $this->dropTable('{{%length}}');
    }
}
