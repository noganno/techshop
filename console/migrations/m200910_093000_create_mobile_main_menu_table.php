<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mobile_main_menu}}`.
 */
class m200910_093000_create_mobile_main_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mobile_main_menu}}', [
            'id' => $this->primaryKey(),
            'category_id'=>$this->integer(),
            'image'=>$this->string(),
            'order'=>$this->integer()->defaultValue(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mobile_main_menu}}');
    }
}
