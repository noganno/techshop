<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute}}`.
 */
class m200808_041056_create_attribute_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%attribute}}', [
            'id' => $this->primaryKey(),
            'attribute_group_id' => $this->integer(),
            'sort_order' => $this->integer(127),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%attribute_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_attribute_lang', '{{%attribute_lang}}', 'owner_id', '{{%attribute}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_attribute_lang', '{{%attribute_lang}}');
        $this->dropTable('{{%attribute_lang}}');
        $this->dropTable('{{%attribute}}');
    }
}
