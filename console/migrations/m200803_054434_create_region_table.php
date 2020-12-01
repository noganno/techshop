<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region}}`.
 */
class m200803_054434_create_region_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(127),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%region_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'name' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_region_lang', '{{%region_lang}}', 'owner_id', '{{%region}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_region_lang', '{{%region_lang}}');
        $this->dropTable('{{%region_lang}}');
        $this->dropTable('{{%region}}');
    }
}
