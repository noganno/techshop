<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sklad}}`.
 */
class m200918_115746_create_sklad_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sklad}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(127),
            'town_id'=>$this->integer(),
            'work_time'=>$this->string(),
            'lat'=>$this->string(),
            'long'=>$this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%sklad_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6),
            'address' => $this->string(255),
            'description' => $this->text(),
        ], $tableOptions);

        $this->addForeignKey('fk_sklad_lang', '{{%sklad_lang}}', 'owner_id', '{{%sklad}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_sklad_lang', '{{%sklad_lang}}');
        $this->dropTable('{{%sklad_lang}}');
        $this->dropTable('{{%sklad}}');
    }

}
