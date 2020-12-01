<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%towns}}`.
 */
class m200803_053259_create_towns_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%towns}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(127),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%towns_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'name' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_towns_lang', '{{%towns_lang}}', 'owner_id', '{{%towns}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_towns_lang', '{{%towns_lang}}');
        $this->dropTable('{{%towns_lang}}');
        $this->dropTable('{{%towns}}');
    }
}
