<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m200805_051342_create_product_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(127),
            'model' => $this->string(255),
            'quantity' => $this->integer(),
            'stock_status_id' => $this->integer(),
            'manufacturer_id' => $this->integer(),
            'price' => $this->decimal(15, 4),
            'sale_price' => $this->decimal(15, 4),
            'weight' => $this->decimal(10, 4),
            'weight_class_id' => $this->integer(),
            'length' => $this->decimal(10, 4),
            'length_class_id' => $this->integer(),
            'sort_order' => $this->integer(),
            'status' => $this->integer(),
            'viewed' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%product_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'tag' => $this->string(255),
            'meta_title' => $this->string(255),
            'meta_description' => $this->string(255),
            'meta_keyword' => $this->string(255),
        ], $tableOptions);

        $this->addForeignKey('fk_product_lang', '{{%product_lang}}', 'owner_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_product_lang', '{{%product_lang}}');
        $this->dropTable('{{%product_lang}}');
        $this->dropTable('{{%post}}');
    }
}
