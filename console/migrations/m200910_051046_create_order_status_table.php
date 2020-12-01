<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_status}}`.
 */
class m200910_051046_create_order_status_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order_status}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(127),
            'status'=>$this->string(255),
            'type'=>$this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%order_status_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_order_status_lang', '{{%order_status_lang}}', 'owner_id', '{{%order_status}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_order_status_lang', '{{%order_status_lang}}');
        $this->dropTable('{{%order_status_lang}}');
        $this->dropTable('{{%order_status}}');
    }

}
