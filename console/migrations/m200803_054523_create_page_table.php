<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page}}`.
 */
class m200803_054523_create_page_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(127),
            'icon_class' => $this->string(127),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%page_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
            'sub_title' => $this->string(255),
            'description' => $this->text(),
            'image' => $this->string(127),
            
        ], $tableOptions);

        $this->addForeignKey('fk_page_lang', '{{%page_lang}}', 'owner_id', '{{%page}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_page_lang', '{{%page_lang}}');
        $this->dropTable('{{%page_lang}}');
        $this->dropTable('{{%page}}');
    }
}
