<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stock_status}}`.
 */
class m200803_054508_create_stock_status_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%stock_status}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%stock_status_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'name' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_stock_status_lang', '{{%stock_status_lang}}', 'owner_id', '{{%stock_status}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_stock_status_lang', '{{%stock_status_lang}}');
        $this->dropTable('{{%stock_status_lang}}');
        $this->dropTable('{{%stock_status}}');
    }
}
