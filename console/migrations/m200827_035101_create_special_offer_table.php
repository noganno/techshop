<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%special_offer}}`.
 */
class m200827_035101_create_special_offer_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%special_offer}}', [
            'id' => $this->primaryKey(),
            'category_id'=>$this->integer(),
            'image'=>$this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%special_offer_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_special_offer_lang', '{{%special_offer_lang}}', 'owner_id', '{{%special_offer}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_special_offer_lang', '{{%special_offer_lang}}');
        $this->dropTable('{{%special_offer_lang}}');
        $this->dropTable('{{%special_offer}}');
    }
}
