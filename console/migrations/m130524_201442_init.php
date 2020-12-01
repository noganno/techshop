<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'full_name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'birth_date' => $this->date(),
            'passport' => $this->string(9),
            'passport_date_of_issue' => $this->date(),
            'passport_date_of_expiry' => $this->date(),
            'passport_authority' => $this->string(),
            'inn' => $this->string(12),
            'town_id' => $this->integer(),
            'region_id' => $this->integer(),
            'address' => $this->string(),
            'work' => $this->string(),
            //Yuridik shaxslar
            'kpp' => $this->string(),
            'company_name' => $this->string(),
            'ogrn' => $this->string(),
            'bik' => $this->string(),
            'account_number' => $this->string()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
