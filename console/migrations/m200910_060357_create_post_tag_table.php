<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_tag}}`.
 */
class m200910_060357_create_post_tag_table extends \soft\db\SMigration
{

    public $tableName = 'post_tag';

    public $multilingiualAttributes = ['name'];

    public function attributes()

    {
        return [
            'name' => $this->string(100)->notNull(),
            'status' => $this->integer(2),
        ];

    }

}
