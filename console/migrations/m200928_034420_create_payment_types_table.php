<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment_types}}`.
 */
class m200928_034420_create_payment_types_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%payment_types}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%payment_types_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
        ], $tableOptions);

        $this->addForeignKey('fk_payment_types_lang', '{{%payment_types_lang}}', 'owner_id', '{{%payment_types}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_payment_types_lang', '{{%payment_types_lang}}');
        $this->dropTable('{{%payment_types_lang}}');
        $this->dropTable('{{%payment_types}}');
    }

}
