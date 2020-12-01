<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m200730_043222_create_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(127),
            'image' => $this->string(127),
            'slider_image' => $this->string(127),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'parent'=>$this->integer()
        ], $tableOptions);

        $this->createTable('{{%category_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'name' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_category_lang', '{{%category_lang}}', 'owner_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_category_lang', '{{%category_lang}}');
        $this->dropTable('{{%category_lang}}');
        $this->dropTable('{{%category}}');
    }
}
